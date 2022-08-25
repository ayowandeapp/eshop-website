<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        //get all categories and sub categories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $categories = json_decode(json_encode($categories));
        //echo "<pre>"; print_r($categories); die;
        //$productAll = Product::orderBy('id', 'DESC')->get();
        $productAll = Product::inRandomOrder()->where('status', 1)->where('feature_item', 1)->paginate(3);
        //$productAll = json_decode(json_encode($productAll));
        //echo "<pre>"; print_r($productAll); die;
        $banners = Banner::where('status','1')->get();
        $banners = json_decode(json_encode($banners));
       // echo "<pre>"; print_r($banners); die;
        $meta_title= "E-shop ecommerce website";
        $meta_description = "Online Shopping Site for Men and Women wears";
        $meta_keywords = "eshop website, ecommerce, online shoping, men wears";

        return view('index')->with(compact('productAll', 'categories','banners', 'meta_title', 'meta_description', 'meta_keywords'));
    }
}
