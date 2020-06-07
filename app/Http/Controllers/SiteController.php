<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Brand;
use App\Models\Url;
use Illuminate\Support\Facades\DB;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Support\Facades\Session;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;

class SiteController extends Controller
{
    use NodeTrait;
   public function welcome(){
       $blogs=Blog::where('published', '1')->limit(9)->get();
       $brands=Brand::limit(9)->get();
       $products = DB::table('products')
           ->where('products.published', '=', 1)
           ->where('products.new', '=', 1)
           ->join('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
           ->join('categories', 'categories.id', '=', 'categoryables.category_id')
           ->join('brands', 'brands.id', '=', 'products.brand_id')
           ->orderBy('created_at', 'desc')
           ->select('categories.title as category_name','products.*','brands.name_brand','categories.path')
           ->limit(9)->get();

       return view('welcome')->with(['blogs'=>$blogs,'brands'=>$brands,'products'=>$products]);
   }

    public function catalog($path='catalog')
    {
        if(isset($_GET['filter_brand'])) $Value1= $_GET['filter_brand'];
        else $Value1= null;
        if(isset($_GET['filter_country'])) $Value2= $_GET['filter_country'];
        else $Value2= null;
        if(isset($_GET['filter_size'])) $Value3= $_GET['filter_size'];
        else $Value3= null;
        if(isset($_GET['filter_color'])) $Value4= $_GET['filter_color'];
        else $Value4= null;
        if(isset($_GET['sort'])){
             if($_GET['sort']=='price'){
                 $Value5='price';
             }elseif($_GET['sort']=='new'){
                 $Value5='created_at';
             }elseif($_GET['sort']=='discount'){
                 $Value5='sale';
             }elseif($_GET['sort']=='popular'){
                 $Value5='updated_at';  ///виправити коли буде додано відвідуваність
             }
        }else {
            $Value5= 'created_at';
        }
        if( $Value5== 'price')$Value6='asc';
        else $Value6='desc';
        $products = DB::table('products')
            ->leftJoin('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
            ->leftJoin('categories', 'categoryables.category_id', '=', 'categories.id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->leftjoin('attributeables','attributeables.product_id', '=', 'products.id')
            ->leftjoin('colors','attributeables.color_id', '=', 'colors.id')
            ->leftjoin('sizes','attributeables.size_id', '=', 'sizes.id')
            ->leftjoin('countries','products.country_id', '=', 'countries.id')
            ->when($Value1, function($query) use ($Value1) {
                $query->whereIn('brands.id', $Value1);
            })
            ->when($Value2, function($query) use ($Value2) {
                $query->whereIn('countries.id', $Value2);
            })
            ->when($Value3, function($query) use ($Value3) {
                $query->whereIn('sizes.brand_name_size', $Value3);
            })
            ->when($Value4, function($query) use ($Value4) {
                $query->whereIn('colors.img_color', $Value4);
            })
            ->orderBy($Value5, $Value6)
            ->select('products.*', 'categories.path', 'categories.title', 'brands.name_brand', 'countries.name_country',
                DB::raw("GROUP_CONCAT(colors.name_color) as name_colors"),
                DB::raw("GROUP_CONCAT(colors.img_color) as img_colors"),
                DB::raw("GROUP_CONCAT(sizes.brand_name_size) as brand_name_sizes")
            )
            ->groupBy('products.id','categories.path','categories.title')
            ->paginate(15);

        $products_filter = DB::table('products')
            ->leftJoin('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
            ->leftJoin('categories', 'categoryables.category_id', '=', 'categories.id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->leftjoin('attributeables','attributeables.product_id', '=', 'products.id')
            ->leftjoin('colors','attributeables.color_id', '=', 'colors.id')
            ->leftjoin('sizes','attributeables.size_id', '=', 'sizes.id')
            ->leftjoin('countries','products.country_id', '=', 'countries.id')
            ->orderBy('created_at', 'desc')
            ->select('products.*', 'categories.path', 'categories.title', 'brands.name_brand', 'countries.name_country',
                DB::raw("GROUP_CONCAT(sizes.brand_name_size) as brand_name_sizes"),
                DB::raw("GROUP_CONCAT(colors.name_color) as name_colors"),
                DB::raw("GROUP_CONCAT(colors.img_color) as img_colors")
            )
            ->groupBy('products.id','categories.path','categories.title')
            ->get();

        foreach ($products_filter as $product_f){
            $filters['brand'][$product_f->brand_id]=$product_f->name_brand;
            $filters['country'][$product_f->country_id]=$product_f->name_country;
            foreach (explode(',', $product_f->brand_name_sizes) as $size){
                $filters['size'][$size]=$size;
            }
            $img_color=explode(',', $product_f->img_colors);
            $i=0;
            foreach (explode(',', $product_f->name_colors) as $color){
                $filters['color'][$color]=$img_color[$i];
                $i++;
            }
        }

        $categories = null;

        $g=Menus::where('id', 3)->with('items')->first();
        $public_menu = $g->items;
        foreach ($public_menu as $menu){
            //$test=Category::descendantsAndSelf(43)->toTree()->toarray();
            $test=Category::withDepth()->having('path', '=', str_replace('/catalog/', '', mb_substr($menu->link, 0, -1)) )->first();
            if(isset($test)){
                $test->toarray();
                $root[] = Category::descendantsAndSelf($test['id'])->toTree()->first()->toarray();
            }else{
                $j['title'] =$menu->label;
                $j['path'] =$menu->link;
                $j['menu'] =1;
                $root[] =$j;
            }
            $test=false;
        }



        return view('category')->with(['categories'=>$categories,'products'=>$products, 'all'=> Product::count(), 'b_menu'=>$root, 'filters'=>$filters]);
    }

    public function category($path)
    {
        $category = Category::where('path', '=', $path)->firstOrFail();
        // Get ids of descendants
        $categories = $category->descendants()->pluck('id');
        // Include the id of category itself
        $categories[] = $category->getKey();
        if(isset($_GET['filter_brand'])) $Value1= $_GET['filter_brand'];
        else $Value1= null;
        if(isset($_GET['filter_country'])) $Value2= $_GET['filter_country'];
        else $Value2= null;
        if(isset($_GET['filter_size'])) $Value3= $_GET['filter_size'];
        else $Value3= null;
        if(isset($_GET['filter_color'])) $Value4= $_GET['filter_color'];
        else $Value4= null;
        if(isset($_GET['sort'])){
            if($_GET['sort']=='price'){
                $Value5='price';
            }elseif($_GET['sort']=='new'){
                $Value5='created_at';
            }elseif($_GET['sort']=='discount'){
                $Value5='sale';
            }elseif($_GET['sort']=='popular'){
                $Value5='updated_at';  ///виправити коли буде додано відвідуваність
            }
        }else {
            $Value5= 'created_at';
        }
        if( $Value5== 'price')$Value6='asc';
        else $Value6='desc';

        $products = DB::table('products')
            ->leftJoin('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
            ->leftJoin('categories', 'categoryables.category_id', '=', 'categories.id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->leftjoin('attributeables','attributeables.product_id', '=', 'products.id')
            ->leftjoin('colors','attributeables.color_id', '=', 'colors.id')
            ->leftjoin('sizes','attributeables.size_id', '=', 'sizes.id')
            ->leftjoin('countries','products.country_id', '=', 'countries.id')
            ->whereIn('categoryables.category_id', $categories)
            ->when($Value1, function($query) use ($Value1) {
                $query->whereIn('brands.id', $Value1);
            })
            ->when($Value2, function($query) use ($Value2) {
                $query->whereIn('countries.id', $Value2);
            })
            ->when($Value3, function($query) use ($Value3) {
                $query->whereIn('sizes.brand_name_size', $Value3);
            })
            ->when($Value4, function($query) use ($Value4) {
                $query->whereIn('colors.img_color', $Value4);
            })
            ->orderBy($Value5, $Value6)
            ->select('products.*', 'categories.path', 'categories.title', 'brands.name_brand', 'countries.name_country',
                DB::raw("GROUP_CONCAT(colors.name_color) as name_colors"),
                DB::raw("GROUP_CONCAT(colors.img_color) as img_colors"),
                DB::raw("GROUP_CONCAT(sizes.brand_name_size) as brand_name_sizes")
                )
            ->groupBy('products.id','categories.path','categories.title')
            ->paginate(15);

        $products_filter= DB::table('products')
            ->leftJoin('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
            ->leftJoin('categories', 'categoryables.category_id', '=', 'categories.id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->leftjoin('attributeables','attributeables.product_id', '=', 'products.id')
            ->leftjoin('colors','attributeables.color_id', '=', 'colors.id')
            ->leftjoin('sizes','attributeables.size_id', '=', 'sizes.id')
            ->leftjoin('countries','products.country_id', '=', 'countries.id')
            ->whereIn('categoryables.category_id', $categories)
            ->orderBy('created_at', 'desc')
            ->select('products.*', 'categories.path', 'categories.title', 'brands.name_brand', 'countries.name_country',
                DB::raw("GROUP_CONCAT(colors.name_color) as name_colors"),
                DB::raw("GROUP_CONCAT(colors.img_color) as img_colors"),
                DB::raw("GROUP_CONCAT(sizes.brand_name_size) as brand_name_sizes")
            )
            ->groupBy('products.id','categories.path','categories.title')
            ->get();

        foreach ($products_filter as $product_f){
            $filters['brand'][$product_f->brand_id]=$product_f->name_brand;
            $filters['country'][$product_f->country_id]=$product_f->name_country;
            foreach (explode(',', $product_f->brand_name_sizes) as $size){
                $filters['size'][$size]=$size;
            }
            $img_color=explode(',', $product_f->img_colors);
            $i=0;
            foreach (explode(',', $product_f->name_colors) as $color){
                $filters['color'][$color]=$img_color[$i];
                $i++;
            }
        }

        $categories = Category::ancestorsAndSelf($category->id);

        $g=Menus::where('id', 3)->with('items')->first();
        $public_menu = $g->items;
            foreach ($public_menu as $menu){
                //$test=Category::descendantsAndSelf(43)->toTree()->toarray();
                $test=Category::withDepth()->having('path', '=', str_replace('/catalog/', '', mb_substr($menu->link, 0, -1)) )->first();
                if(isset($test)){
                    $test->toarray();
                    $root[] = Category::descendantsAndSelf($test['id'])->toTree()->first()->toarray();
                }else{
                    $j['title'] =$menu->label;
                    $j['path'] =$menu->link;
                    $j['menu'] =1;
                    $root[] =$j;
                }
                $test=false;
            }



        return view('category')->with(['category'=>$category,'categories'=>$categories,'products'=>$products, 'all'=> Product::count(), 'b_menu'=>$root, 'filters'=>$filters]);
    }

    public function product($categoryPath, $productSlug)
    {

        // Сначала находим раздел по пути
        $category = Category::where('path', '=', $categoryPath)->firstOrFail();

        // Затем в этом разделе ищем товар с указанной заглушкой
        $product = DB::table('products')
            ->leftJoin('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
            ->leftJoin('categories', 'categoryables.category_id', '=', 'categories.id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->leftjoin('attributeables','attributeables.product_id', '=', 'products.id')
            ->leftjoin('countries','products.country_id', '=', 'countries.id')
            ->where('products.slug', '=', $productSlug)
            ->orderBy('created_at', 'desc')
            ->select('products.*', 'categories.path', 'categories.title', 'brands.name_brand', 'brands.url  as brands_url', 'countries.name_country')
            ->groupBy('products.id','categories.path','categories.title')
            ->first();
        $attr_all = DB::table('attributeables')
            ->where('product_id', '=', $product->id)
            ->leftjoin('colors','attributeables.color_id', '=', 'colors.id')
            ->leftjoin('sizes','attributeables.size_id', '=', 'sizes.id')
            ->select('attributeables.*', 'colors.name_color',  'colors.img_color', 'sizes.rus_name_size','sizes.brand_name_size','sizes.grudi_size','sizes.talii_size','sizes.pod_grudyu_size','sizes.bedra_size','sizes.stopy_size' )
            ->get()->toArray();
        $attr_colors = array();
        foreach ($attr_all as $c) {
            $attr_colors[$c->img_color] = $c; // Get unique country by code.
        }
        $attr_sizes = array();
        foreach ($attr_all as $s) {
            $attr_sizes[$s->brand_name_size] = $s; // Get unique country by code.
        }



        $category = Category::where('path', '=', $categoryPath)->firstOrFail();
        // Get ids of descendants
        $categories_o = $category->descendants()->pluck('id');
        // Include the id of category itself
        $categories_o[] = $category->getKey();
        $similar_p = DB::table('products')
            ->leftJoin('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
            ->leftJoin('categories', 'categoryables.category_id', '=', 'categories.id')
            ->whereIn('categoryables.category_id', $categories_o)
            ->where('products.id', '!=', $product->id)
            ->orderBy('created_at', 'desc')
            ->select('products.*', 'categories.path', 'categories.title')
            ->groupBy('products.id','categories.path','categories.title')
            ->get(20);
        $categories = Category::ancestorsAndSelf($category->id);

        /*Ласт*/
        $recent = Session::get('recent');
        if (!is_array($recent)) {
            $recent = array();
        }
        $recent[] = $product->id;
        while (count($recent) > 20) {
            array_shift($recent);
        }
        $recent=array_unique($recent);
        Session::put('recent', $recent);
        $last_p = DB::table('products')
            ->leftJoin('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
            ->leftJoin('categories', 'categoryables.category_id', '=', 'categories.id')
            ->whereIn('products.id', $recent)
            ->where('products.id', '!=', $product->id)
            ->select('products.*', 'categories.path', 'categories.title')
            ->groupBy('products.id','categories.path','categories.title')
            ->get();
        /*Ласт*/
        $media =explode(';', $product->media);
        return view('product')->with(['categories'=>$categories,'product'=>$product,'attr_all'=>$attr_all,'attr_sizes'=>$attr_sizes,'attr_colors'=>$attr_colors,'similar_p'=>$similar_p,'last_p'=>$last_p, 'media' => $media]);
    }


    public function blogs()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(6);
        return view('blogs')->with(['blogs'=>$blogs]);
    }

    public function blog($url)
    {
        $blog = Blog::where('url', '=', $url)->first();
        return view('blog')->with(['blog'=>$blog]);
    }
    public function page($url)
    {
        $page = Page::where('url', '=', $url)->first();
        return view('page')->with(['page'=>$page]);
    }

    public function brands()
    {
        $brands = Brand::orderBy('created_at', 'desc')->get()->toarray();
        foreach ($brands as $brand){
            $abc= substr($brand['name_brand'], 0,1);
            $brands_sort[$abc][]=$brand;
        }
        ksort($brands_sort, SORT_STRING);
        $count = count($brands);
        return view('brands')->with(['brands'=>$brands_sort, 'count'=>$count]);
    }
    public function brand($url)
    {
        $products = DB::table('products')
            ->leftJoin('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
            ->leftJoin('categories', 'categoryables.category_id', '=', 'categories.id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->where('brands.url', $url)
            ->orderBy('created_at', 'desc')
            ->select('products.*', 'categories.path', 'categories.title', 'brands.name_brand', 'brands.description_brand', 'brands.logo_brand')
            ->groupBy('products.id','categories.path','categories.title')
            ->paginate(15);


        $products_filter = DB::table('products')
            ->leftJoin('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
            ->leftJoin('categories', 'categoryables.category_id', '=', 'categories.id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->leftjoin('attributeables','attributeables.product_id', '=', 'products.id')
            ->leftjoin('colors','attributeables.color_id', '=', 'colors.id')
            ->leftjoin('sizes','attributeables.size_id', '=', 'sizes.id')
            ->leftjoin('countries','products.country_id', '=', 'countries.id')
            ->orderBy('created_at', 'desc')
            ->select('products.*', 'categories.path', 'categories.title', 'brands.name_brand', 'countries.name_country',
                DB::raw("GROUP_CONCAT(sizes.brand_name_size) as brand_name_sizes"),
                DB::raw("GROUP_CONCAT(colors.name_color) as name_colors"),
                DB::raw("GROUP_CONCAT(colors.img_color) as img_colors")
            )
            ->groupBy('products.id','categories.path','categories.title')
            ->get();

        foreach ($products_filter as $product_f){
            $filters['brand'][$product_f->brand_id]=$product_f->name_brand;
            $filters['country'][$product_f->country_id]=$product_f->name_country;
            foreach (explode(',', $product_f->brand_name_sizes) as $size){
                $filters['size'][$size]=$size;
            }
            $img_color=explode(',', $product_f->img_colors);
            $i=0;
            foreach (explode(',', $product_f->name_colors) as $color){
                $filters['color'][$color]=$img_color[$i];
                $i++;
            }
        }

        $categories = null;

        $g=Menus::where('id', 3)->with('items')->first();
        $public_menu = $g->items;
        foreach ($public_menu as $menu){
            //$test=Category::descendantsAndSelf(43)->toTree()->toarray();
            $test=Category::withDepth()->having('path', '=', str_replace('/catalog/', '', mb_substr($menu->link, 0, -1)) )->first();
            if(isset($test)){
                $test->toarray();
                $root[] = Category::descendantsAndSelf($test['id'])->toTree()->first()->toarray();
            }else{
                $j['title'] =$menu->label;
                $j['path'] =$menu->link;
                $j['menu'] =1;
                $root[] =$j;
            }
            $test=false;
        }
        $count = $products->count();
        $brand = Brand::where('url', '=', $url)->firstOrFail();

        return view('brand')->with(['brand_one'=>$brand, 'products'=>$products, 'count'=>$count, 'b_menu'=>$root, 'filters'=>$filters]);
    }

    public function sizes()
    {
        $brands = Brand::orderBy('created_at', 'desc')->get()->toarray();
        foreach ($brands as $brand){
            $brands_sort[$brand['name_brand']]=$brand;
        }
        ksort($brands_sort, SORT_STRING);
        return view('sizes')->with(['brands'=>$brands_sort]);
    }
    public function size($url)
    {
        $brands = Brand::orderBy('created_at', 'desc')->get()->toarray();
        foreach ($brands as $brand){
            $brands_sort[$brand['name_brand']]=$brand;
        }
        ksort($brands_sort, SORT_STRING);
        $size = Brand::where('url','=', $url)->first();
        return view('size')->with(['brands'=>$brands_sort, 'size'=>$size]);
    }

    public function productID($id)
    {
        $product=Product::where('id',$id)->first();

        return redirect($product->getUrl());
    }
}
