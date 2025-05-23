<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = ['parent_id','name'];

    public function ads(){
        return $this->hasMany(Ad::class);
    }

    public function subAds(){
        return $this->hasManyThrough(Ad::class,Category::class,'parent_id','category_id');
    }

    public function parentCategory(){
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function subCategories(){
        return $this->hasMany(Category::class,'parent_id');
    }
}
