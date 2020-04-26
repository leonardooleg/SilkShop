<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Url;
use Illuminate\Support\Facades\DB;
use Kalnoy\Nestedset\NodeTrait;

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
        return view('category')->with(['categories'=>$categories,'products'=>$products]);
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
            ->leftjoin('colors','attributeables.color_id', '=', 'colors.id')
            ->leftjoin('sizes','attributeables.size_id', '=', 'sizes.id')
            ->leftjoin('countries','products.country_id', '=', 'countries.id')
            ->where('products.slug', '=', $productSlug)
            ->orderBy('created_at', 'desc')
            ->select('products.*', 'categories.path', 'categories.title', 'brands.name_brand', 'countries.name_country',
                DB::raw("GROUP_CONCAT(colors.name_color) as name_colors"),
                DB::raw("GROUP_CONCAT(colors.img_color) as img_colors"),
                DB::raw("GROUP_CONCAT(sizes.brand_name_size) as brand_name_sizes"),
                DB::raw("GROUP_CONCAT(sizes.rus_name_size) as rus_name_sizes")
            )
            ->groupBy('products.id','categories.path','categories.title')
            ->first();

        $categories = Category::ancestorsAndSelf($category->id);
        return view('product')->with(['categories'=>$categories,'product'=>$product]);
    }


}
