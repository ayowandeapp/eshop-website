<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function mainCategories()
    {
        $mainCategories = Category::where(['parent_id' => 0])->get();
        //$mainCategories = json_decode(json_encode($mainCategories));
        //echo "<pre>"; print_r($mainCategories);
        return $mainCategories;
    }
    public static function search(){
        $categories = Category::where(['parent_id'=> 0])->get();
        $categories_dropdown = "<option selected disabled> Select </option>";
        foreach($categories as $cat){
            $categories_dropdown .= "<option value ='".$cat->id."'>".$cat->name. "</option>";
            $sub_categories =  Category::where(['parent_id'=> $cat->id])->get();
            foreach($sub_categories as $subcat){
                $categories_dropdown .= "<option value ='".$subcat->id."'>&nbsp;--&nbsp;".$subcat->name. "</option>";
            }
        }
        return $categories_dropdown;

    }
}
