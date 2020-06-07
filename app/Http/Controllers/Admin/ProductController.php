<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
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
            'sizes' => Size::all(),
            'colors' => Color::all(),
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

        return view('admin.products.edit', [
            'brands' => Brand::all(),
            'providers' => Provider::all(),
            'countries' => Country::all(),
            'sizes' => Size::all(),
            'colors' => Color::all(),
            'attributeables' => DB::table('attributeables')->where('product_id', '=', $id)->get(),
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
     */
    public function destroy(Product $product)
    {
        $product->categories()->detach();
        $product->delete();
        return redirect()->route('admin.products.index');
    }

}
