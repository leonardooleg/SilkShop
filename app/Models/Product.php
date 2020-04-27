<?php

namespace App\Models;

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



}
