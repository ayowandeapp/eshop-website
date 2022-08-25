<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public static function getCategoryName($categoryId){
        $getCategoryName  = Category::select('name')->where('id', $categoryId)->first();
        return $getCategoryName->name;
    }
    public function categories(){
        return $this->hasMany('App\Category', 'parent_id');
    }
    public static function mainCategories(){
        $mainCategories = Category::where(['parent_id'=> 0])->get();
        return $mainCategories;

    }
}
