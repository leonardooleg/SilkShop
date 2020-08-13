<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryImport;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Country;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use SimpleXLSX;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = DB::table('products')
            ->join('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
            ->join('categories', 'categories.id', '=', 'categoryables.category_id')
            ->orderBy('created_at', 'desc')
            ->select('categories.title as category_name','products.*')
            ->paginate(15);
        return view('admin.products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        global $categories2;

        $nodes = Category::get()->toTree();
        $traverse = function ($categories, $prefix = '') use (&$traverse) {
            global $categories2;
            foreach ($categories as $category) {
                $categories2.=  '<option value="'.$category->id.'"> '.$prefix.' '.$category->title.' </option>';
                $traverse($category->children, $prefix.'-');
            }
        };
        $traverse($nodes);
        return view('admin.products.create', [
            'brands' => Brand::all(),
            'providers' => Provider::all(),
            'countries' => Country::all(),
            /*'sizes' => Size::all(),
            'colors' => Color::all(),*/
            'categories' =>$categories2,
            'delimiter'  => ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $product = new Product($request->except('color_id', 'size_id'));
        $product->user_id=Auth::id();
        if(isset($product->media)) $product->media=implode(';', array_diff( $product->media, array('')));
        $product->save();

        $sizes=array_diff( $request['size_id'], array(''));
        $colors=array_diff( $request['color_id'], array(''));
        $i=0;
        foreach ($sizes as $size){
            $isert[]=['color_id' => $colors[$i], 'size_id' => $size, 'product_id' => $product->id];
            $i++;
        };
        DB::table('attributeables')->insert($isert);
        // Categories
        if($request->input('categories')) :
            $product->categories()->attach($request->input('categories'));
        endif;
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return Response
     */
    public function show(Category $Products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $Products
     * @return Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands= Brand::all();
        global $categoryID;
        $categoryID= DB::table('categoryables')->where('categoryable_id',$product->id)->first();
        $categoryID= $categoryID->category_id;
        global $categories2;
        $nodes = Category::get()->toTree();
        $traverse = function ($categories, $prefix = '-') use (&$traverse) {
            global $categories2;
            global $categoryID;
            foreach ($categories as $category0) {
                if($categoryID==$category0->id) $categories2.=  '<option value="'.$category0->id.'" selected> '.$prefix.' '.$category0->title.' </option>';
                else $categories2.=  '<option value="'.$category0->id.'"> '.$prefix.' '.$category0->title.' </option>';
                $traverse($category0->children, $prefix.'-');
            }
        };
        $traverse($nodes);

        $attributeables = DB::table('attributeables')
            ->where('product_id', '=', $id)
            ->join('sizes', 'sizes.id', '=', 'attributeables.size_id')
            ->join('colors', 'colors.id', '=', 'attributeables.color_id')
            ->select('attributeables.id','attributeables.size_id', 'attributeables.color_id', 'sizes.rus_name_size', 'sizes.brand_name_size', 'colors.name_color')
            ->get();
        return view('admin.products.edit', [
            'brands' => Brand::all(),
            'providers' => Provider::all(),
            'countries' => Country::all(),
            'attributeables' => $attributeables,
            'categories' =>$categories2,
            'product' => $product,
            'delimiter'  => ''
        ]);
    }

    /**
     * Update the given user.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $input = $request->except('color_id', 'size_id');
        $input['media']=implode(';', array_diff( $input['media'], array('')));
        $product->fill($input)->save();
        $sizes=array_diff( $request['size_id'], array(''));
        $colors=array_diff( $request['color_id'], array(''));
        $i=0;
        foreach ($sizes as $size){
                $isert[]=['color_id' => $colors[$i], 'size_id' => $size, 'product_id' => $product->id];
                $i++;
        };
        DB::table('attributeables')->where('product_id', '=', $product->id)->delete();
        DB::table('attributeables')->insert( $isert);
        // Categories
        $product->categories()->detach();
        if($request->input('categories')) :
            $product->categories()->attach($request->input('categories'));
        endif;
        return back()->with('success', 'Your Product has been added successfully. Please wait for the admin to approve.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $category
     * @return Response
     **/
    public function destroy(Product $product)
    {
        $product->categories()->detach();
        $product->delete();
        return redirect()->route('admin.products.index');
    }

    public function import(){
        return view('admin.products.import');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function import_store(Request $request){
        $import_file = $request->file('import_file'); //при завантажені файлів


        if ($import_file) {
            $data = "storage/". $import_file->store('uploads/import', 'public');
            if ( $xlsx = SimpleXLSX::parse($data) ) {
                $arrs= $xlsx->rows() ; //отримали дані в масиві з exel
                $i=0;
                foreach ($arrs as $arr){
                    if($i==0){
                        $i++;
                        continue;
                    }
                    $i++;
                    if(isset($code) && $code==$arr[13]) {
                        $product->count= $product->count +1;
                        //знов повтор вставки розміру і кольору
                        $attributes = $product->attributes($product, $arr);
                    }else {
                        $code=$arr[13];
                        if(isset($code) && $code==$arr[13] &&isset($product)) {
                            $product->save();
                        }
                        $product = Product::where('vendor_code','=', $code)->first();
                        if($product){
                            $product->media= $arr[15];
                            $product->new= 0;
                            if($arr[17]=="Да")
                                $product->sale = 1;
                            else
                                $product->sale = 0;
                            $product->price= $arr[7];
                            $product->count= 1;
                            DB::table('attributeables')->where('product_id', '=', $product->id)->delete();
                            $attributes = $product->attributes($product, $arr);
                        }else{
                            $product = new Product();
                            $product->name= $arr[14];
                            $product->code= $arr[0];
                            $product->vendor_code= $arr[13];


                            $provider = Provider::where('provider_name','=', $arr[12])->first();
                            if(!$provider){
                                $provider = new Provider();
                                $provider->provider_name=$arr[12];
                                $provider->save();
                            }
                            $product->provider_id = $provider->id;
                            $product->material= $arr[11];

                            $country = Country::where('name_country','=', $arr[9])->first();
                            if(!$country){
                                $country = new Country();
                                $country->name_country=$arr[9];
                                $country->save();
                            }
                            $product->country_id = $country->id;
                            $product->media= $arr[15];

                            $product->new = 1;
                            if($arr[17]=="Да")
                                $product->sale = 1;
                            else
                                $product->sale = 0;


                            $product->description= $arr[10];
                            $product->price= $arr[7];
                            $product->count= 1;
                            $product->user_id= 1;
                            $product->published= 0;
                            $product->slug = Str::slug( mb_substr($arr[14], 0, 40) ,'-');
                            $product->save();
                            $attributes = $product->attributes($product, $arr);
                            $product->brand_id = $attributes['brand_id'];
                            // Categories
                            $categories = Category::where('title','=', $arr[2])->first();
                            if(!$categories){
                                $site_category = CategoryImport::where('import_name', '=', $arr[2])->first();
                                if(isset($site_category))$site_category=$site_category->category_id;
                                if(!$site_category){
                                    $categories_parent = Category::where('title','=', $arr[1])->first();
                                    if(!$categories_parent){
                                        $site_category_parent = CategoryImport::where('import_name', '=', $arr[1])->first();
                                        if(isset($site_category_parent))$site_category_parent=$site_category_parent->category_id;
                                        if(!$site_category_parent){
                                            $categories_parent = new Category();
                                            $categories_parent->title = $arr[1];
                                            $categories_parent->slug = '';
                                            $categories_parent->save();

                                            $categories_parent_id= $categories_parent->id;
                                            $categories = new Category();
                                            $categories->title = $arr[2];
                                            $categories->slug = '';
                                            $categories->save();
                                            $categories->parent_id = $categories_parent_id;
                                            $categories->save();
                                        }else{
                                            $categories_id=$site_category_parent;
                                        }
                                    }
                                }else{
                                    $categories_id=$site_category;
                                }


                            }
                            if(!isset($categories_id)) $categories_id=$categories->id;

                            $product->categories()->attach($categories_id);
                            $product->save();
                        }
                    }



                }
            } else {
                echo SimpleXLSX::parseError();
            }
        }




        return redirect()->route('admin.products.index');


    }
}
