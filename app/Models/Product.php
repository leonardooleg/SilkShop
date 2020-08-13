<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Product extends Model
{

    protected $fillable = ['name', 'code', 'vendor_code', 'provider_id', 'brand_id', 'material', 'country_id', 'size_id', 'color_id', 'media', 'new', 'sale', 'description', 'price', 'count', 'user_id', 'slug','published', 'created_by', 'updated_at'];
    protected $guarded = [];

    // Получение ссылки
    public function getUrl()
    {
        $url= $this->categories[0];
        return 'catalog/'.$url->path.'/'.$this->slug.'.html';
    }

    public function setSlugAttribute($value) {
        if( $value==="" || $value==null){
            $this->attributes['slug'] = Str::slug( mb_substr($this->name, 0, 40) ,'-');
        }else{
            $this->attributes['slug'] = Str::slug( $value);
        }
    }



    // Polymorphic relation with categories
    public function categories()
    {
        return $this->morphToMany('App\Models\Category', 'categoryable');
    }
    public function scopeLastProducts($query, $count){
        return $query->orderBy('created_at', 'desc')->take($count)->get();
    }

    public function attributes($product, $arr){
        //найти ід кольору і розміру
        $brand = Brand::where('name_brand','=', $arr[3])->first();
        if(!$brand){
            $brand = new Brand();
            $brand->name_brand=$arr[3];
            $brand->save();
        }
        $brand_id = $brand->id;

        $color=Color::where('img_color','=', $arr[5])->first();
        if(!$color){
            $color = new Color();
            $color->name_color = $arr[4];
            $color->img_color = $arr[5];
            $color->brand_id = $brand_id;
            $color->save();
        }
        $id_color=$color->id;
        $size=Size::where('brand_name_size','=', $arr[6])->where('brand_id','=',$brand_id)->first();
        if(!$size){
            $size = new Size();
            $size->brand_name_size = $arr[6];
            $size->category_id = $product->categories[0]->id;
            $size->brand_id = $brand_id;
            $size->save();
        }
        $id_size=$size->id;
        DB::table('attributeables')->insert(
            ['color_id' => $id_color, 'size_id' => $id_size, 'product_id' => $product->id]
        );
        $ret['brand_id'] = $brand_id;
        return $ret;
    }

}
