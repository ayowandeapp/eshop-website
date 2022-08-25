<?php

namespace App\Http\Controllers;

use App\Category;
use App\Coupon;
use App\Currency;
use App\DeliveryAddress;
use App\Order;
use App\OrdersProduct;
use App\Product;
use App\User;
use App\Country;
use App\ProductAttribute;
use App\ProductsAttribute;
use App\ProductsImage;
use Carbon\Carbon;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Image;

class ProductController extends Controller
{
    public function addProduct(Request $request){
        if(Session::get('adminType')['products_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if(empty($data['category_id'])){
                return redirect()->back()->with('message_error', 'Category is not Selected');
            }
            $product = new Product;
            $product->category_id = $data['category_id'];
            $product->product_name= $data['product_name'];
            $product->product_code= $data['product_code'];
            $product->product_color= $data['product_color'];
            if(!empty($data['description'])){
                $product->description= $data['description'];
            }else{
                $product->description= '';
            }
            if(!empty($data['care'])){
                $product->care= $data['care'];
            }else{
                $product->care= '';
            }
            $product->price= $data['product_price'];

            //add image
            if($request ->hasFile('image')) {
                //get filename with extension
                $image = $request->file('image');
                //get filename without extension
                $input['imagename'] = time(). '.'.$image->getClientOriginalExtension();
                //get file extension

                // echo "<pre>"; print_r($input['imagename']); die;
                //Upload File
                $destinationPath = public_path('/images/backend_images/products/small');
                $img = Image::make($image->getRealPath());
                $img->resize(300,300, function($constraint){ $constraint->aspectRatio(); })->save($destinationPath. '/'.$input['imagename']);

                $destinationPath = public_path('/images/backend_images/products/medium');
                $img = Image::make($image->getRealPath());
                $img->resize(600,600, function($constraint){ $constraint->aspectRatio(); })->save($destinationPath. '/'.$input['imagename']);

                $destinationPath = public_path('/images/backend_images/products/large');
                $img = Image::make($image->getRealPath());
                $img->resize(1200,1200, function($constraint){ $constraint->aspectRatio(); })->save($destinationPath. '/'.$input['imagename']);

                $product->image= $input['imagename'];
            }
            if(empty($data['status'])){
                $status = '0';
            }else{
                $status = '1';
            }
            if(empty($data['feature_item'])){
                $feature_item = '0';
            }else{
                $feature_item = '1';
            }
            //add video
            if($request ->hasFile('video')) {
                //get filename with extension
                $video = $request->file('video');
                //get filename without extension
                $input['videoname'] = time(). '.'.$video->getClientOriginalExtension();
                $video_path = 'videos/';
                $video->move($video_path,$input['videoname']);
                $product->video =  $input['videoname'];
            }
            $product->status = $status;
            $product->feature_item = $feature_item;
            $product->save();
            return redirect('/admin/view-products/')->with('message_success', 'Product Added successfully');
        }
        $categories = Category::where(['parent_id'=> 0])->get();
        $categories_dropdown = "<option selected disabled> Select </option>";
        foreach($categories as $cat){
            $categories_dropdown .= "<option value ='".$cat->id."'>".$cat->name. "</option>";
            $sub_categories =  Category::where(['parent_id'=> $cat->id])->get();
            foreach($sub_categories as $subcat){
                $categories_dropdown .= "<option value ='".$subcat->id."'>&nbsp;--&nbsp;".$subcat->name. "</option>";
            }
        }
        return view('admin.products.add_product')->with(compact('categories_dropdown'));
    }
    public function viewProducts(Request $request){
        if(Session::get('adminType')['products_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        $products = Product::orderby('id', 'DESC')->get();
        $products = json_decode(json_encode($products));

        return view('admin.products.view_products')->with(compact('products'));

    }
    public function editProduct(Request $request, $id= null){
        if(Session::get('adminType')['products_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        if($request->isMethod('post')){
            $data = $request->all();
            //add image
            if($request ->hasFile('image')) {
                //get filename with extension
                $image = $request->file('image');
                //get filename without extension
                $input['imagename'] = time(). '.'.$image->getClientOriginalExtension();
                //get file extension
                // echo "<pre>"; print_r($input['imagename']); die;
                //Upload File
                $destinationPath = public_path('/images/backend_images/products/small');
                $img = Image::make($image->getRealPath());
                $img->resize(300,300, function($constraint){ $constraint->aspectRatio(); })->save($destinationPath. '/'.$input['imagename']);

                $destinationPath = public_path('/images/backend_images/products/medium');
                $img = Image::make($image->getRealPath());
                $img->resize(600,600, function($constraint){ $constraint->aspectRatio(); })->save($destinationPath. '/'.$input['imagename']);

                $destinationPath = public_path('/images/backend_images/products/large');
                $img = Image::make($image->getRealPath());
                $img->resize(1200,1200, function($constraint){ $constraint->aspectRatio(); })->save($destinationPath. '/'.$input['imagename']);
            }else{
                $input['imagename'] = $data['current_image'];
            }
            if(empty($data['care'])){
                $care = '';
            }else{
                $care  =$data['care'];
            }
            if(empty($data['status'])){
                $status = '0';
            }else{
                $status = '1';
            }
            if(empty($data['feature_item'])){
                $feature_item = '0';
            }else{
                $feature_item = '1';
            }
            //add video
            if($request ->hasFile('video')) {
                //get filename with extension
                $video = $request->file('video');
                //get filename without extension
                $input['videoname'] = time(). '.'.$video->getClientOriginalExtension();
                $video_path = 'videos/';
                $video->move($video_path,$input['videoname']);

            }else{
                if(empty($data['current_video'])){
                    $data['current_video']='';
                }
                $input['videoname'] = $data['current_video'];
            }
            Product::where(['id'=>$id])->update([
                'category_id'=>$data['category_id'],
                'product_name'=>$data['product_name'],
                'product_code'=>$data['product_code'],
                'product_color'=>$data['product_color'],
                'description'=>$data['description'],
                'image'=>$input['imagename'],
                'care'=>$care,
                'price'=>$data['product_price'],
                'video' =>  $input['videoname'],
                'status'=>$status,
                'feature_item' =>$feature_item
            ]);
            return redirect('/admin/view-products')->with('message_success', 'Product Updated Successfully!');
        }
        $productDetails = Product::where(['id'=> $id])->first();

        $categories = Category::where(['parent_id'=> 0])->get();
        $categories_dropdown = "<option selected disabled> Select </option>";
        foreach($categories as $cat){
            if($cat->id == $productDetails->category_id ){
                $selected = "Selected";
                }else{
                $selected = "";
            }
            $categories_dropdown .= "<option value ='".$cat->id."' ".$selected."> ".$cat->name." </option>";
            $sub_categories =  Category::where(['parent_id'=> $cat->id])->get();
            foreach($sub_categories as $subcat){
                if($subcat->id == $productDetails->category_id ){
                    $selected = "Selected";
                }else{
                    $selected = "";
                }

                $categories_dropdown .= "<option value ='".$subcat->id."'  ".$selected.">&nbsp;--&nbsp;".$subcat->name. "</option>";
            }
        }
        return view('admin.products.edit_product')->with(compact('productDetails', 'categories_dropdown'));
    }
    public function deleteProduct($id=null){
        if(Session::get('adminType')['products_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        Product::where(['id'=>$id])->delete();
        return redirect()->back()->with('message_success', 'Product Deleted successfully');
    }
    public function deletePhoto($id=null){
        if(Session::get('adminType')['products_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        $productImg = Product::where(['id'=>$id])->first();
       //echo $productImg->image; die;

        //get image path
        $large_path = 'images/backend_images/products/large/';
        $medium_path = 'images/backend_images/products/medium/';
        $small_path = 'images/backend_images/products/small/';

        //delete
        if(file_exists($large_path.$productImg->image)){
            unlink($large_path.$productImg->image);
        }
        if(file_exists($medium_path.$productImg->image)){
            unlink($medium_path.$productImg->image);
        }
        if(file_exists($small_path.$productImg->image)){
            unlink($small_path.$productImg->image);
        }
        Product::where(['id'=>$id])->update(['image'=>'']);
        return redirect()->back()->with('message_success', 'Product Image Deleted');
    }
    public function deleteVideo($id=null){
        if(Session::get('adminType')['products_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        $productVideo = Product::where(['id'=>$id])->first();
        //get video path
        $video_path = 'videos/';
        //delete
        if(file_exists($video_path.$productVideo->video)){
            unlink($video_path.$productVideo->video);
        }
        Product::where(['id'=>$id])->update(['video'=>'']);
        return redirect()->back()->with('message_success', 'Product Video Deleted Successfully');
    }
    public function addAttribute(Request $request, $id= null){
        if(Session::get('adminType')['products_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();
       // $productDetails = json_decode(json_encode($productDetails), true);
       //echo "<pre>"; print_r($productDetails); die;
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            foreach($data['sku'] as $key =>$val){
                if(!empty($val)){
                    $skuCount=ProductsAttribute::where('sku',$val)->count();
                    if($skuCount>0){
                        return redirect()->back()->with('message_error', 'Product sku Already Exist');
                    }
                    $sizeCount=ProductsAttribute::where(['product_id'=>$id, 'size'=> $data['size'][$key]])->count();
                    if($sizeCount>0){
                        return redirect()->back()->with('message_error', '"'.$data['size'][$key].'" Product size Already Exist');
                    }
                    $productAttribute = new ProductsAttribute;
                    $productAttribute->	product_id = $data['product_id'];
                    $productAttribute->	sku = $val;
                    $productAttribute->	size = $data['size'][$key];
                    $productAttribute->	price = $data['price'][$key];
                    $productAttribute->	stock = $data['stock'][$key];
                    $productAttribute->save();
                }
            }
            return redirect('/admin/add-attribute/'.$id)->with('message_success', 'Product Attribute Added');

            //echo "<pre>"; print_r($data); die;

        }
        return view('admin.products.add_attributes')->with(compact('productDetails'));
    }
    public function addProductImages(Request $request, $id= null){
        if(Session::get('adminType')['products_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        $productDetails = Product::where('id',$id)->first();
        if($request->isMethod('post')){
            $data = $request->all();
           // echo "<pre>"; print_r($data); die;

            //add image
            if($request ->hasFile('image')) {
                //get filename with extension
                $images = $request->file('image');
                foreach($images as $image){
                    $product = new ProductsImage;
                    $product->product_id= $data['product_id'];
                    //get filename without extension
                    $input['imagename'] = time(). '.'.$image->getClientOriginalExtension();
                    //get file extension

                    // echo "<pre>"; print_r($input['imagename']); die;
                    //Upload File
                    $destinationPath = public_path('/images/backend_images/products/small');
                    $img = Image::make($image->getRealPath());
                    $img->resize(300,300, function($constraint){ $constraint->aspectRatio(); })->save($destinationPath. '/'.$input['imagename']);

                    $destinationPath = public_path('/images/backend_images/products/medium');
                    $img = Image::make($image->getRealPath());
                    $img->resize(600,600, function($constraint){ $constraint->aspectRatio(); })->save($destinationPath. '/'.$input['imagename']);

                    $destinationPath = public_path('/images/backend_images/products/large');
                    $img = Image::make($image->getRealPath());
                    $img->resize(1200,1200, function($constraint){ $constraint->aspectRatio(); })->save($destinationPath. '/'.$input['imagename']);

                    $product->image= $input['imagename'];
                    $product->save();
                }
            }


        }
        $productImages = ProductsImage::where(['product_id'=> $id])->get();
        return view('admin.products.add_images')->with(compact('productDetails','productImages'));
    }
    public function deleteProductImages($id=null){
        if(Session::get('adminType')['products_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        $productImg = ProductsImage::where(['id'=>$id])->first();
        //echo $productImg->image; die;

        //get image path
        $large_path = 'images/backend_images/products/large/';
        $medium_path = 'images/backend_images/products/medium/';
        $small_path = 'images/backend_images/products/small/';

        //delete
        if(file_exists($large_path.$productImg->image)){
            unlink($large_path.$productImg->image);
        }
        if(file_exists($medium_path.$productImg->image)){
            unlink($medium_path.$productImg->image);
        }
        if(file_exists($small_path.$productImg->image)){
            unlink($small_path.$productImg->image);
        }
        ProductsImage::where(['id'=>$id])->delete();
        return redirect()->back()->with('message_success', 'Product Image Deleted');
    }
    public function deleteAttribute($id= null){
        if(Session::get('adminType')['products_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
       // echo "<pre>"; print_r($id); die;
        ProductsAttribute::where(['id'=>$id])->delete();
        return redirect()->back()->with('message_success', 'Product Attribute Deleted');
    }
    public function editAttribute ($id= null, Request $request){
        if(Session::get('adminType')['products_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            foreach($data['idAttr'] as $key => $attr){
                ProductsAttribute::where(['id'=>$data['idAttr'][$key]])->update(['price'=>$data['price'][$key], 'stock'=>$data['stock'][$key]]);
            }
            return redirect()->back()->with('message_success', 'Product Attributes Updated');
        }

    }
    public function products($url= null){

            //show 404 error
        $count = Category::where(['url'=> $url, 'status'=>'1'])->count();
       // echo $count;die;
        if($count==0){
            abort(404);
        }
        //get all categories and sub categories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        $categoryDetails = Category::where('url', $url)->first();
        if($categoryDetails->parent_id == 0){
            //show sub category product
            $subCategories = Category::where(['parent_id'=> $categoryDetails->id])->get();
            foreach($subCategories as $subcat){
                $cat_ids[]= $subcat->id;
            }
            //echo $cat_ids; die;
            $productAll = Product::whereIn('category_id',$cat_ids);
            $breadCrumb= "<a href='/'>Home</a> / <a href='".$categoryDetails->url."'>".$categoryDetails->name."</a>";
        }else{
            $mainCategory = Category::where('id', $categoryDetails->parent_id)->first();
            $breadCrumb= "<a href='/'>Home</a> / <a href='".$mainCategory->url."'>".$mainCategory->name."</a> / <a href='".$categoryDetails->url."'>".$categoryDetails->name."</a>";
            //if url is sub category
            $productAll = Product::where(['category_id'=> $categoryDetails->id]);
        }
        //filter by color
        if(!empty($_GET['color'])){
            $colorArray  = explode("-", $_GET['color']);
            if($categoryDetails->parent_id == 0){
                $productAll = Product::whereIn('category_id',$cat_ids)->whereIn('product_color', $colorArray);
            }else{
                $productAll = Product::where(['category_id'=> $categoryDetails->id])->whereIn('product_color', $colorArray);
            }
           }
        $productAll=$productAll->where('status', 1)->orderBy('id', 'Desc')->paginate(6);
        //echo "<pre>"; print_r($productAll); die;
        //color filter
        //$colorArrays= array('Blue', 'Black', 'Red', 'Brown', 'Green', 'Gold', 'Grey', 'Orange', 'White'); groupBy does not allow duplicate of results
        $colorArrays= Product::select('product_color')->groupBy('product_color')->get();
        $colorArrays = array_flatten(json_decode(json_encode($colorArrays), true));
        $meta_title= $categoryDetails->meta_title;
        $meta_description= $categoryDetails->meta_description;
        $meta_keywords= $categoryDetails->meta_keywords;
        return view('products.listing')->with(compact('colorArrays','productAll', 'categoryDetails', 'categories','breadCrumb','meta_title','meta_description', 'meta_keywords', 'url'));
    }
    public function productFilter(Request $request){
        $data = $request->all();
        //echo "<pre>"; print_r($data); die;
        $colorUrl='';
        if(!empty($data['colorFilter'])){
            foreach($data['colorFilter'] as $color){
                if(empty($colorUrl)){
                    $colorUrl= "&color=".$color;
                }else{
                    $colorUrl.= "-". $color;
                }
            }
        }
        $finalUrl = "products/". $data['url']."?".$colorUrl;
        return redirect::to($finalUrl);
    }
    public function searchProduct(Request $request){
        $data = $request->all();
        $search = $data['searchTxt'];
        $output = '';
        $searchProduct = Product::where(function($query) use($search){
           $query->where('product_name', 'LIKE', "%$search%")
                 ->orwhere('product_code', 'LIKE', "%$search%")
               ->orwhere('description', 'LIKE', "%$search%");
        })->where('status',1);

        if($searchProduct->count() == 0){
            $output = "no result";
        }else{
            foreach($searchProduct->orderBy('created_at','Desc')->get() as $product){
                $url =  route('productdetail.page',$product->id);
                $image = asset('/images/backend_images/products/large/'.$product->image);
                $price = $product->price;
                $pricename = $product->product_name;
                $output.='
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                   <a href="'.$url.' "><img src="'.$image.'" alt="" /></a>
                    <h2>$ '.$price.'</h2>
                    <p>'.$pricename.'</p>
                    <a href="'.$url.'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                </ul>
            </div>
        </div>
    </div>';

            }
        }
        echo $output;
    }
    public function product($id= null){
        //redirect to 404 if product is disabled or product does not exist
        $ProductCount = Product::where(['id'=> $id, 'status'=>0])->count();
        if($ProductCount >0){
            abort(404);
        }
        $ProductExistCount = Product::where('id', $id)->count();
        if($ProductExistCount ==0){
            abort(404);
        }
        //get all categories and sub categories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
            /* $count = Category::where(['id'=> $id, 'status'=>1])->count();
            // echo $count;die;
            if($count==0){
                abort(404);
            }
        */
        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();
        //echo "<pre>"; print_r($productDetails); die;
        $categoryDetails = Category::where('id', $productDetails->category_id)->first();
        if($categoryDetails->parent_id == 0){
            $breadCrumb= "<a href='/'>Home</a> / <a href='/products/".$categoryDetails->url."'>".$categoryDetails->name."</a> /  ".$productDetails->product_name."";
        }else{
            $mainCategory = Category::where('id', $categoryDetails->parent_id)->first();
            $breadCrumb= "<a href='/'>Home</a> / <a href='/products/".$mainCategory->url."'>".$mainCategory->name."</a> / <a href='/products/".$categoryDetails->url."'>".$categoryDetails->name."</a> / ".$productDetails->product_name."";
            //if url is sub category
            $productAll = Product::where(['category_id'=> $categoryDetails->id]);
        }

        $relatedProducts = Product::where('id','!=', $id)->where(['category_id'=>$productDetails->category_id])->get();

        $productAltImages = ProductsImage::where('product_id',$id)->get();

        $total_stock = ProductsAttribute::where(['product_id'=>$id])->sum('stock');
        $meta_title= $productDetails->product_name;
        $meta_description= $productDetails->description;
        $meta_keywords= $productDetails->product_name;
        return view('products.detail')->with(compact('productDetails','breadCrumb','categories', 'productAltImages','total_stock', 'relatedProducts','meta_title','meta_description', 'meta_keywords'));
    }
    public function productSearch(Request  $request){
        //get all categories and sub categories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $minPrice = $data['minPrice'];
            $maxPrice = $data['maxPrice'];
            $categoryDetails = Category::where('id', $data['category'])->first();
            //$categoryId= json_decode(json_encode($categoryId));
            //echo "<pre>"; print_r($categoryId); die;
            if($categoryDetails->parent_id == 0){
                //show sub category product
                $subCategories = Category::where(['parent_id'=> $categoryDetails->id])->get();
                foreach($subCategories as $subcat){
                    $cat_ids[]= $subcat->id;
                }
                //echo $cat_ids; die;
                $productAll = Product::whereIn('category_id',$cat_ids)->where('status', 1)->get();
            }else{
                //if url is sub category
                $productAll = Product::where(['category_id'=> $categoryDetails->id])->where('status', 1)->get();
            }
           // echo "<pre>"; print_r($productAll); die;

            return view('products.listing')->with(compact('productAll', 'categoryDetails', 'categories', 'minPrice', 'maxPrice'));

            }

    }
    public function instantSearch(){
        $categories = Category::with('categories')->where(['parent_id'=>0])->where('status','1')->get();
        return view('products.instant_search')->with(compact('categories'));
    }
    public function productPrice(Request  $request){
        $data = $request->all();
        //echo "<pre>"; print_r($data); die;
        $arr = explode('-', $data['idSize']);
        //echo "<pre>"; print_r($arr); die;
        $prorr = ProductsAttribute::where(['product_id'=> $arr[0], 'size'=>$arr[1] ])->first();
        $price= Currency::getCurrencyRate($prorr->price);
        foreach($price as $p){
            echo  $p."-";
        }
        echo '#';
        echo $prorr->price. "-". $prorr->stock;

    }
    public function addCart(Request $request){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if(empty($data['size'])){
                return redirect()->back()->with('message_error', 'Select a Product Size');
            }
            if(!empty($data['wishListButton']) && $data['wishListButton'] == "WishList"){
                //check if logged in
                if(!Auth::check()){
                    return redirect()->back()->with('message_success', 'Please Login to add product to Wish List.');
                }
                $size= explode('-', $data['size']);
                //getProductPrice
                $getProductPrice= ProductsAttribute::where(['product_id'=>$data['product_id'],'size'=>$size[1]])->first();
                $product_price = $getProductPrice->price;
                //get user email
                $user_email =Auth::user()->email;
                //set quantity to 1
                $quantity = 1;
                //get current date
                $created_at = Carbon::now();
                $wishListCount = DB::table('wish_list')->where(['user_email'=>$user_email,'product_id'=>$data['product_id'], 'size'=>$size[1]])->count();
                if($wishListCount >0){
                    return redirect()->back()->with('message_error', 'Product already Added to Wish List.');
                }else{
                //insert in to wish list table
                    DB::table('wish_list')->insert(['product_id'=>$data['product_id'], 'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],
                        'product_color'=>$data['product_color'], 'size'=>$size[1],'price'=>$product_price, 'quantity'=>$quantity,'user_email'=>$user_email, 'created_at'=>$created_at]);
                    return redirect()->back()->with('message_success','Product has been added to Wish List');
                }
            }else{
              //  echo 'cart'; die;
                $size= explode('-', $data['size']);
                //echo "<pre>"; print_r($size);
                //echo $size[0]; die;
                $session_id = Session::get('session_id');
                $cartCount= DB::table('cart')->where(['product_id'=> $data['product_id'],'size'=>$size[1],'product_color'=>$data['product_color'],'session_id'=>$session_id])->count();
                if ($cartCount >0){
                    return redirect('cart')->with('message_success', 'Product Added to Cart Already ');
                }else{

                    $getSKU = ProductsAttribute::select('sku')->where(['product_id'=> $data['product_id'], 'size'=>$size[1]])->first();

                    if(empty(Auth::user()->email)){
                        $user_email = '';
                    }else{
                        $user_email = Auth::user()->email;
                    }
                    $session_id = Session::get('session_id');
                    if(empty($session_id)){
                        $session_id = str_random(40);
                        Session::put('session_id', $session_id);
                    }
                    $stockCount = ProductsAttribute::where(['product_id'=> $data['product_id'],'sku'=>$getSKU->sku,'size'=>$size[1]])->first();
                    if($stockCount->stock < $data['quantity']){
                        return redirect()->back()->with('message_error', 'Required Quantity is not Available');
                    }
                    DB::table('cart')->insert(['product_id'=> $data['product_id'],
                        'product_name'=>$data['product_name'],'product_code'=>$getSKU->sku,'product_color'=>$data['product_color'],'price'=>$data['price'],
                        'size'=>$size[1], 'quantity'=> $data['quantity'], 'user_email'=> $user_email, 'session_id'=>$session_id]);
                    return redirect('cart')->with('message_success', 'Product Added to Cart ');
                }
            }

            }
    }
    public function wishList(){
        if(Auth::check()){
            $user_email = Auth::user()->email;
            $getWishList = DB::table('wish_list')->where('user_email',$user_email)->get();
            foreach($getWishList as $key => $item){
                $productDetails = Product::where('id', $item->product_id)->first();
                $getWishList[$key]->image = $productDetails->image;
            }
        }else{
            $getWishList = array();
        }

        $meta_title= "WishList - Ecom Website";
        return view('products.wish_list')->with(compact('getWishList', 'meta_title'));
    }
    public function deleteWishList($id=null){
        $user_email = Auth::user()->email;
        DB::table('wish_list')->where(['user_email'=>$user_email, 'id'=>$id])->delete();
        return redirect()->back()->with('message_success', 'Product Removed from Wish List Successfully');
    }
    public function cart(){
        if(Auth::check()){
            $userEmail = Auth::user()->email;
            $userCart = DB::table('cart')->where(['user_email'=>$userEmail])->get();
            if(!empty(Session::get('session_id'))){
                $session_id = Session::get('session_id');
                $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
            }
        }else{
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        }
        //get image of product
        foreach($userCart as $key => $item){
            $productDetails = Product::where('id', $item->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }
        //echo "<pre>"; print_r($userCart); die;
        //get product price from productAttribute table directly
        foreach($userCart as $key => $item){
            $productPrice = Product::getProductPrice($item->product_id, $item->size);
            $userCart[$key]->price = $productPrice->price;
        }

        $meta_title= "Cart - Ecom Website";
        return view('products.cart')->with(compact('userCart', 'meta_title'));
    }
    public function cartQuantity($id=null, $quantity=null){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $getCartDetail= DB::table('cart')->where('id',$id)->first();
        $getAttributeStock = ProductsAttribute::where('sku', $getCartDetail->product_code)->first();
        $updated_quantity =$getCartDetail->quantity+$quantity;
        if($getAttributeStock->stock >= $updated_quantity){
            DB::table('cart')->where('id',$id)->increment('quantity', $quantity);
            return redirect()->back()->with('message_success', 'Product increased Successfully');
        }
        return redirect()->back()->with('message_error', 'Product quantity is not available');

    }
    public function couponCode (Request $request){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $request->all();
        //echo "<pre>"; print_r($data); die;
        $couponCount = Coupon::where('coupon_code', $data['coupon_code'])->count();
        if($couponCount == 0){
            return redirect()->back()->with('message_error', 'Coupon does not exist');
        }else{
            //coupon detail
            $couponDetail = Coupon::where('coupon_code', $data['coupon_code'])->first();
            //check if active
            if($couponDetail->status =='0'){
                return redirect()->back()->with('message_error', 'Coupon is InActive');
            }


            //check expiry date
            $expiry_date= $couponDetail->expiry_date;
            $current_date  = date('Y-m-d');
            if($expiry_date< $current_date){
                return redirect()->back()->with('message_error', 'Coupon Expired');
            }
            //get cart total
            $session_id = Session::get('session_id');
            //get user detail
            if(Auth::check()){
                $userEmail = Auth::user()->email;
                $userCart = DB::table('cart')->where(['user_email'=>$userEmail])->get();
            }else{
                $session_id = Session::get('session_id');
                $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
            }
            $totalAmount = 0;
            foreach($userCart as $item){
                $totalAmount = $totalAmount + ($item->quantity * $item->price);
            }
            //check amount type
            if($couponDetail->amount_type == 'fixed'){
                $couponAmount = $couponDetail->amount;
            }else{
                $couponAmount = $totalAmount * ($couponDetail->amount/100);

            }
            //put coupon code & amount i session
            Session::put('CouponAmount', $couponAmount);
            Session::put('CouponCode', $data['coupon_code']);
            return redirect()->back()->with('message_success', 'Coupon Successfully Applied!');

        }
    }
    public function deleteCartProduct($id =null){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        DB::table('cart')->where(['id'=>$id])->delete();
        return redirect()->back()->with('message_error', 'Product Removed Successfully');
    }
    public function checkout(Request $request){
        //get user detail
        $user= Auth::user()->id;
        $userEmail= Auth::user()->email;
        $userDetail = User::find($user);

        $countries = Country::all();
        $countries=json_decode(json_encode($countries));

        //check if billing address exit
        $shippingCount = DeliveryAddress::where('user_id', $user)->count();
        $shippingDetail = array();
        if($shippingCount>0){
            $shippingDetail =  DeliveryAddress::where('user_id', $user)->first();
          //echo "<pre>"; print_r($shippingDetail); die;
        }
        //update cart table
        $getsession = Session::get('session_id');
        DB::table('cart')->where(['session_id'=> $getsession])->update(['user_email'=>$userEmail]);

        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            //return to checkout page is any field is empty
            if(empty($data['Billing_name']) || empty($data['Billing_address']) || empty($data['Billing_city']) || empty($data['Billing_state']) ||
                empty($data['Billing_country']) || empty($data['Billing_pincode']) ||empty($data['Billing_mobile'])
                ||empty($data['shipping_name']) || empty($data['shipping_address']) || empty($data['shipping_city']) || empty($data['shipping_state']) ||
                empty($data['shipping_country']) || empty($data['shipping_pincode']) ||empty($data['shipping_mobile']) ){
                return redirect()->back()->with('message_error', 'Please Fill in the field');
            }

            //update user details
            User::where('id', $user)->update(['name'=>$data['shipping_name'], 'address'=>$data['shipping_address'], 'city'=>$data['shipping_city'],
            'state'=>$data['shipping_state'], 'country'=>$data['shipping_country'], 'pincode'=> $data['shipping_pincode'], 'mobile'=>$data['shipping_mobile']]);
/*

            if($shippingCount>0){
                //update shipping address
                DeliveryAddress::where('user_id', $user)->update(['name'=>$data['Billing_name'], 'address'=>$data['Billing_address'], 'city'=>$data['Billing_city'],
                    'state'=>$data['Billing_state'], 'country'=>$data['Billing_country'], 'pincode'=> $data['Billing_pincode'], 'mobile'=>$data['Billing_mobile']]);

            }else{
*/
            $shippingCount = DeliveryAddress::where(['user_id'=>$user, 'order_id'=>''])->count();
            if($shippingCount>0){
                //update shipping address
                DeliveryAddress::where(['user_id'=>$user, 'order_id'=>''])->update(['name'=>$data['Billing_name'], 'address'=>$data['Billing_address'], 'city'=>$data['Billing_city'],
                    'state'=>$data['Billing_state'], 'country'=>$data['Billing_country'], 'pincode'=> $data['Billing_pincode'], 'mobile'=>$data['Billing_mobile']]);
            }else{
                //add new shipping address
                $shipping = new DeliveryAddress;
                $shipping->user_id= $user;
                $shipping->order_id= '';
                $shipping->user_email = $userEmail;
                $shipping->name = $data['Billing_name'];
                $shipping->address = $data['Billing_address'];
                $shipping->city = $data['Billing_city'];
                $shipping->state = $data['Billing_state'];
                $shipping->country = $data['Billing_country'];
                $shipping->pincode = $data['Billing_pincode'];
                $shipping->mobile = $data['Billing_mobile'];
                $shipping->save();
            }
            return redirect('/order-review');
        }
        $meta_title= "Checkout - Ecom Website";
        return view('users.checkout')->with(compact('countries','userDetail','shippingDetail', 'meta_title' ));
    }
    public function orderReview(){
        //get user detail
        $session_id = Session::get('session_id');
        if(Auth::check()){
            $userEmail = Auth::user()->email;
            $userCart = DB::table('cart')->where(['user_email'=> $userEmail, 'session_id'=>$session_id])->get();
        }else{

            $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        }
        $user= Auth::user()->id;
        $userDetail = User::find($user);
        $shippingDetail =  DeliveryAddress::where(['user_id'=> $user,'order_id'=>''])->first();
        $shippingDetail= json_decode(json_encode($shippingDetail));
        //get product image
        foreach($userCart as $key => $item){
            $productDetails = Product::where('id', $item->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }
        //get product price from productAttribute table directly
        foreach($userCart as $key => $item){
            $productPrice = Product::getProductPrice($item->product_id, $item->size);
            $userCart[$key]->price = $productPrice->price;
        }
        $meta_title= "Order Review - Ecom Website";
        return view('products.order_review')->with(compact('shippingDetail','userDetail', 'userCart', 'meta_title' ));
    }
    public function placeOrder(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
           //echo "<pre>"; print_r($data); die;
            if(empty($data['payment_method'])){
                return redirect()->back();
            }
            $user_email = Auth::user()->email;
            $session_id = Session::get('session_id');
            $getCartProducts = DB::table('cart')->where(['user_email'=> $user_email, 'session_id'=>$session_id])->get();
            $getCartProducts= json_decode(json_encode($getCartProducts));
            //echo "<pre>"; print_r($getCartProducts); die;
            foreach($getCartProducts as $product){
                //redirect to 404 if product is disabled or product does not exist
                $ProductCount = Product::where(['id'=> $product->product_id, 'status'=>0])->count();
                if($ProductCount >0){
                    abort(404);
                }
                $ProductExistCount = Product::where(['id'=> $product->product_id])->count();
                if($ProductExistCount ==0){
                    abort(404);
                }
                //if category as been disabled
                $getCategoryId = Product::select('category_id')->where('id',$product->product_id)->first();
                $getCategoryStatus = Product::getCategoryStatus($getCategoryId->category_id);
                if($getCategoryStatus->status ==0){
                    Product::deleteCartProduct($product->product_id,$user_email);
                    return redirect('/cart')->with('message_error', 'Product '.$product->product_name.' Category does not exist!');
                }
                //if Product Attribute does not exist
                $attributeExist = Product::getProductAttribute($product->product_id,$product->product_code);
                if($attributeExist==0){
                    //echo 'okay'; die;
                    Product::deleteCartProduct($product->product_id,$user_email);
                    return redirect('/cart')->with('message_error', 'Product '.$product->product_name.' not Available for the size. Try Again!');
                }
                //if out of stock
                $stockCount = Product::productAttributeStock($product->product_id,$product->product_code);
                //echo $stockCount; die;
                if($stockCount->stock == 0){
                    Product::deleteCartProduct($product->product_id,$user_email);
                    //echo 'okay'; die;
                    return redirect('/cart')->with('message_error', 'Product '.$product->product_name.' as been sold out!');
                }
                if($stockCount->stock < $product->quantity){
                    return redirect('/cart')->with('message_error', 'Reduce Product '.$product->product_name.' Quantity!');
                }
            }
             $user_id= Auth::user()->id;
            //get shipping detail
            $shippingDetail = DeliveryAddress::where(['user_email'=>$user_email])->first();
            //get discount from session
            if(empty(Session::has('CouponCode'))){
                $data['coupon_code'] = '';
            }else{
                $data['coupon_code'] = Session::get('CouponCode');
            }
            if(empty(Session::has('CouponAmount'))){
                $data['coupon_amount'] = '';
            }else{
               $data['coupon_amount'] = Session::get('CouponAmount');
            }
             $grandTotal= Product::getGrandTotal();
            $order = new Order;
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name = $shippingDetail->name;
            $order->address = $shippingDetail->address;
            $order->city  = $shippingDetail->city;
            $order->state = $shippingDetail->state;
            $order->country = $shippingDetail->country;
            $order->pincode = $shippingDetail->pincode;
            $order->mobile = $shippingDetail->mobile;
            $order->coupon_code = $data['coupon_code'];
            $order->coupon_amount = $data['coupon_amount'];
            $order->order_status = "New";
            $order->payment_method = $data['payment_method'];
            $order->grand_total = $grandTotal;
            $order->save();
            //get last order_id
            $order_id = DB::getPdo()->lastInsertId();
            //update deliveryAddress
            DeliveryAddress::where(['user_id'=>$user_id, 'order_id'=>''])->update(['order_id'=>$order_id]);
            //get cart product
            $getCartProducts = DB::table('cart')->where(['user_email'=> $user_email, 'session_id'=>$session_id])->get();
            $getCartProducts= json_decode(json_encode($getCartProducts));
           //echo "<pre>"; print_r($getCartProducts); die;
            foreach($getCartProducts as $pro){
                $orderP = new OrdersProduct;
                $orderP->user_id = $user_id;
                $orderP->order_id = $order_id;
                $orderP->product_id = $pro->product_id;
                $orderP->product_name = $pro->product_name;
                $orderP->product_code = $pro->product_code;
                $orderP->product_color = $pro->product_color;
                $orderP->product_size = $pro->size;
                $product_price = Product::getProductPrice($pro->product_id, $pro->size);
                $orderP->product_price = $product_price->price;
                $orderP->product_qty = $pro->quantity;
                $orderP->save();
                //update stock
                $getProductStock = ProductsAttribute::select('stock')->where('sku',$pro->product_code)->first();
                $newStockQty = $getProductStock->stock - $pro->quantity;
                ProductsAttribute::where('sku',$pro->product_code)->update(['stock'=>$newStockQty]);

            }
            Session::put('order_id', $order_id);
            Session::put('grand_total', $grandTotal);
            if($data['payment_method'] == "COD"){

                $productDetails = Order::with('orders')->where('id',$order_id)->first();
                $productDetails = json_decode(json_encode($productDetails));
                //echo "<pre>"; print_r($productDetails); die;

                $userDetails= User::where('email', $user_email)->first();
                $userDetails = json_decode(json_encode($userDetails));
                //echo "<pre>"; print_r($userDetails); die;
                $messageData = [
                    'email'=>$user_email,
                    'name'=>$shippingDetail->name,
                    'order_id'=>$order_id,
                    'productDetails' => $productDetails,
                    'userDetails' => $userDetails
                ];
                Mail::send('emails.order', $messageData,function($message) use($user_email){
                    $message->to($user_email)->subject('Order Placed - online Shopping');
                });
                return redirect('/thanks');
            }else{
                //paypal
                return redirect('/paypal');
            }
        }
        return view();
    }
    public function paypal(){

    }
    public function thanks(Request $request){

        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email',$user_email)->delete();

        return view('orders.thanks');
    }
    public function userOrder(){
        $user_id = Auth::user()->id;
        $orders = Order::with('orders')->where('user_id', $user_id)->orderBy('id', 'DESC')->get();
        $orders = json_decode(json_encode($orders));
        //echo "<pre>"; print_r($orders); die;

        return view('orders.user_order')->with(compact('orders'));
    }
    public function userOrderProduct($order_id){
        $user_id = Auth::user()->id;
        $ordersDetail = Order::with('orders')->where('id', $order_id)->orderBy('id', 'DESC')->first();
        $ordersDetail = json_decode(json_encode($ordersDetail));
        //echo "<pre>"; print_r($ordersDetail); die;
        return view('orders.user_order_details')->with(compact('ordersDetail'));
    }
    //admin
    public function viewOrder(){
        //echo Session::get('adminType')['orders_access']; die;
        if(Session::get('adminType')['orders_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        $orders = Order::with('orders')->orderBy('id', 'Desc')->get();
        $orders = json_decode(json_encode($orders));
        //echo "<pre>"; print_r($orders); die;
        return view('admin.order.view_order')->with(compact('orders'));
    }
    public function viewOrderChart(){
        if(Session::get('adminType')['orders_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        $order = Order::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
        $chart = Charts::database($order, 'bar', 'highcharts')->title("Monthly Orders")->elementLabel("Total Orders")->dimensions(1000, 500)->responsive(false)->groupByMonth(date('Y'), true);
        return view('admin.order.view_order_charts')->with(compact('chart'));
    }
    public function viewOrderProduct($order_id=null){
        if(Session::get('adminType')['orders_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        $orders = Order::with('orders')->where('id', $order_id)->first();
        $orders = json_decode(json_encode($orders));
        //echo "<pre>"; print_r($orders); die;
        $userDetails = User::where('id', $orders->user_id)->first();
        $userDetails = json_decode(json_encode($userDetails));
        //echo "<pre>"; print_r($userDetails); die;
        $shippingAdd = DeliveryAddress::where(['user_id'=>$orders->user_id, 'order_id'=>$orders->id])->first();
        $shippingAdd = json_decode(json_encode($shippingAdd));
        //echo "<pre>"; print_r($shippingAdd); die;
        return view('admin.order.view_order_detail')->with(compact('orders', 'userDetails', 'shippingAdd'));
    }
    public function viewOrderInvoice($order_id=null){
        if(Session::get('adminType')['orders_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        $orders = Order::with('orders')->where('id', $order_id)->first();
        $orders = json_decode(json_encode($orders));
        //echo "<pre>"; print_r($orders); die;
        $userDetails = User::where('id', $orders->user_id)->first();
        $userDetails = json_decode(json_encode($userDetails));
        //echo "<pre>"; print_r($userDetails); die;
        $shippingAdd = DeliveryAddress::where(['user_id'=>$orders->user_id, 'order_id'=>$order_id])->first();
        $shippingAdd = json_decode(json_encode($shippingAdd));
        //echo "<pre>"; print_r($shippingAdd); die;
        return view('admin.order.order_invoice')->with(compact('orders', 'userDetails', 'shippingAdd'));
    }
    public function updateOrderStatus(Request $request, $order_id = null){
        if(Session::get('adminType')['orders_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            Order::where('id', $order_id)->update(['order_status'=>$data['orderUpdate']]);
            return redirect()->back()->with('message_success', 'Order Status Updated Succesfully');
        }
    }
}
