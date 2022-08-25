<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Product extends Model
{
    public function attributes(){
        return $this->hasMany('\App\ProductsAttribute', 'product_id');
    }
    public static  function cartCount(){
        $cartSession = Session::get('session_id');
        if(Auth::check()){
            $user_email = Auth::user()->email;
            $cartCount = DB::table('cart')->where(['user_email'=> $user_email, 'session_id'=>$cartSession])->sum('quantity');
        }else{
            $cartCount = DB::table('cart')->where('session_id', $cartSession)->sum('quantity');
        }
        if(empty($cartCount)){
            $cartCount = 0;
        }
        return $cartCount;
    }
    public static function productCount($cat_id =null){
        $productCount = Product::where(['category_id'=> $cat_id, 'status'=>1])->count();
        return $productCount;
    }
    public static function getProductAttribute($product_id=null, $product_code=null){
        $attributeCount = ProductsAttribute::where(['product_id'=>$product_id,'sku'=> $product_code])->count();
        return $attributeCount;
    }
    public static function getProductPrice($product_id, $product_size){
        $productPrice = ProductsAttribute::select('price')->where(['product_id'=>$product_id, 'size'=>$product_size])->first();
        return $productPrice;
    }
    public static function deleteCartProduct($product_id=null, $userEmail=null){
        DB::table('cart')->where(['product_id'=>$product_id,'user_email'=> $userEmail])->delete();
    }
    public static function productAttributeStock($product_id=null, $product_code=null){
        $attributeCount = ProductsAttribute::select('stock')->where(['product_id'=>$product_id,'sku'=> $product_code])->first();
        return $attributeCount;
    }
    public static function getCategoryStatus($category_id){
        $categoryStatus= Category::select('status')->where('id', $category_id)->first();
        return $categoryStatus;
    }
    public static function getGrandTotal(){
        $userEmail = Auth::user()->email;
        $session_id = Session::get('session_id');
        $userCart = DB::table('cart')->where(['user_email'=>$userEmail, 'session_id'=>$session_id])->get();
        foreach($userCart as $cart){
            $productPrice = ProductsAttribute::where(['product_id'=>$cart->product_id, 'sku'=>$cart->product_code,'size'=>$cart->size])->first();
            $priceArray[]= $productPrice->price;
        }
        $grandTotal =array_sum($priceArray) - Session::get('CouponAmount');
        return $grandTotal;
    }

}
