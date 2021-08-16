<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','name','url','description','price'];

    public static function boot()
    {
        static::addGlobalScope('orderByPrice',function (Builder $builder ){
            $builder->orderBy('price','desc');
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
