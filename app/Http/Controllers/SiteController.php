<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Url;
use Illuminate\Support\Facades\DB;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Support\Facades\Session;

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
        $products = DB::table('products')
            ->leftJoin('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
            ->leftJoin('categories', 'categoryables.category_id', '=', 'categories.id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->leftjoin('attributeables','attributeables.product_id', '=', 'products.id')
            ->leftjoin('colors','attributeables.color_id', '=', 'colors.id')
            ->leftjoin('sizes','attributeables.size_id', '=', 'sizes.id')
            ->orderBy('created_at', 'desc')
            ->select('products.*', 'categories.path', 'categories.title', 'brands.name_brand',
                DB::raw("GROUP_CONCAT(colors.name_color) as name_colors"),
                DB::raw("GROUP_CONCAT(colors.img_color) as img_colors"),
                DB::raw("GROUP_CONCAT(sizes.brand_name_size) as brand_name_sizes")
            )
            ->groupBy('products.id','categories.path','categories.title')
            ->paginate(15);


        $categories = null;
        return view('category')->with(['categories'=>$categories,'products'=>$products]);
    }

    public function category($path)
    {
        $category = Category::where('path', '=', $path)->firstOrFail();
        // Get ids of descendants
        $categories = $category->descendants()->pluck('id');
        // Include the id of category itself
        $categories[] = $category->getKey();
        $products = DB::table('products')
            ->leftJoin('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
            ->leftJoin('categories', 'categoryables.category_id', '=', 'categories.id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->leftjoin('attributeables','attributeables.product_id', '=', 'products.id')
            ->leftjoin('colors','attributeables.color_id', '=', 'colors.id')
            ->leftjoin('sizes','attributeables.size_id', '=', 'sizes.id')
            ->whereIn('categoryables.category_id', $categories)
            ->orderBy('created_at', 'desc')
            ->select('products.*', 'categories.path', 'categories.title', 'brands.name_brand',
                DB::raw("GROUP_CONCAT(colors.name_color) as name_colors"),
                DB::raw("GROUP_CONCAT(colors.img_color) as img_colors"),
                DB::raw("GROUP_CONCAT(sizes.brand_name_size) as brand_name_sizes")
                )
            ->groupBy('products.id','categories.path','categories.title')
            ->paginate(5);

        $categories = Category::ancestorsAndSelf($category->id);
        return view('category')->with(['category'=>$category,'categories'=>$categories,'products'=>$products]);
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
            ->select('products.*', 'categories.path', 'categories.title', 'brands.name_brand', 'countries.name_country')
            ->groupBy('products.id','categories.path','categories.title')
            ->first();
        $attr_all = DB::table('attributeables')
            ->where('product_id', '=', $product->id)
            ->leftjoin('colors','attributeables.color_id', '=', 'colors.id')
            ->leftjoin('sizes','attributeables.size_id', '=', 'sizes.id')
            ->select('attributeables.*', 'colors.name_color', 'colors.img_color', 'sizes.rus_name_size','sizes.brand_name_size','sizes.grudi_size','sizes.talii_size','sizes.pod_grudyu_size','sizes.bedra_size','sizes.stopy_size' )
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
        return view('product')->with(['categories'=>$categories,'product'=>$product,'attr_all'=>$attr_all,'attr_sizes'=>$attr_sizes,'attr_colors'=>$attr_colors,'similar_p'=>$similar_p,'last_p'=>$last_p]);
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

}
