<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Product extends Model
{
    use NodeTrait;
    protected $fillable = ['name', 'code', 'vendor_code', 'provider_id', 'brand_id', 'material', 'country_id', 'size_id', 'color_id', 'media', 'new', 'sale', 'description', 'price', 'count', 'user_id', 'slug','published', 'created_by', 'updated_at'];
    protected $guarded = [];

    /*protected static function boot()
    {
        parent::boot();
        static::saving(function (self $model) {
            if ($model->isDirty('slug', 'parent_id') ) {
                $model->generatePath();
            }
        });

        static::saved(function (self $model) {
            // Данная переменная нужна для того, чтобы потомки не начали вызывать
            // метод, т.к. для них путь также изменится
            static $updating = false;
            if ( ! $updating && $model->isDirty('path')) {
                $updating = true;
                $model->updateDescendantsPaths();
                $updating = false;
            }
        });
    }

    // Генерация пути
    public function generatePath()
    {
        $slug = $this->slug;
        $this->slug = $slug;
        return $this;
    }

    public function updateDescendantsPaths()
    {
        // Получаем всех потомков в древовидном порядке
        $descendants = $this->descendants()->defaultOrder()->get();
        // Данный метод заполняет отношения parent и children
        $descendants->push($this)->linkNodes()->pop();
        foreach ($descendants as $model) {
            $model->generatePath()->save();
        }
    }*/

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
