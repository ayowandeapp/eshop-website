<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 /*Route::get('/', function () {
    return view('welcome');
});
 */

//home page
Route::get('/', [
    'uses'=>'IndexController@index',
    'as' => 'index.page'
]);
//list product page
Route::get('/products/{url}', [
    'uses'=>'ProductController@products',
    'as' => 'products.page'
]);
//product detail pge
Route::get('/product/{id}',[
    'uses'=>'ProductController@product',
    'as' => 'productdetail.page'
]);
//get product price
Route::get('/get-product-price',[
    'uses'=>'ProductController@productPrice'
]);
Route::match(['get', 'post'],'/add-cart',[
    'uses'=>'ProductController@addCart',
    'as' => 'addtocart'
]);
//show cart
Route::match(['get', 'post'],'/cart',[
    'uses'=>'ProductController@cart',
    'as' => 'cart.page'
]);
//update quantity
Route::get('/cart/update-quantity/{id}/{quantity}',[
    'uses'=>'ProductController@cartQuantity'
]);
Route::get('/cart/delete-item/{id}',[
    'uses'=>'ProductController@deleteCartProduct',
    'as' => 'deletecartproduct.page'
]);
Route::post('/cart/coupon',[
    'uses'=>'ProductController@couponCode'
]);

Route::get('/admin',[
    'uses'=>'AdminController@login',
    'as' => 'login.page'
]);
Route::post('/admin',[
    'uses'=>'AdminController@login',
    'as' => 'login.page'
]);

Route::group(['middleware' => ['adminlogin']], function(){

    Route::get('/admin/dashboard',[
        'uses'=>'AdminController@dashboard',
        'as' => 'dashboard.page'
    ]);
    Route::get('/admin/settings',[
        'uses'=>'AdminController@setting',
        'as' => 'setting.page'
    ]);
    Route::get('/admin/check-pwd',[
        'uses'=>'AdminController@chkPassword',
        'as' => 'chkpassword.page'
    ]);
    Route::match(['get', 'post'],'/admin/update-pwd',[
        'uses'=>'AdminController@updatePassword',
        'as' => 'updatepassword.page'
    ]);
    Route::match(['get', 'post'],'/admin/add-category',[
        'uses'=>'CategoryController@addCategory',
        'as' => 'addcategory.page'
    ]);
    Route::match(['get', 'post'],'/admin/edit-category/{id}',[
        'uses'=>'CategoryController@editCategory',
        'as' => 'editcategory.page'
    ]);
    Route::match(['get', 'post'],'/admin/view-category',[
        'uses'=>'CategoryController@viewCategory',
        'as' => 'viewcategory.page'
    ]);
    Route::match(['get', 'post'],'/admin/delete-category/{id}',[
        'uses'=>'CategoryController@deleteCategory',
        'as' => 'deletecategory.page'
    ]);
    Route::match(['get', 'post'],'/admin/add-product',[
        'uses'=>'ProductController@addProduct',
        'as' => 'addproduct.page'
    ]);
    Route::match(['get', 'post'],'/admin/view-products',[
        'uses'=>'ProductController@viewProducts',
        'as' => 'viewproduct.page'
    ]);
    Route::match(['get', 'post'],'/admin/edit-product/{id}',[
        'uses'=>'ProductController@editProduct',
        'as' => 'editproduct.page'
    ]);
    Route::get('/admin/delete-product/{id}',[
        'uses'=>'ProductController@deleteProduct',
        'as' => 'deleteproduct.page'
    ]);
    Route::get('/admin/delete-photo/{id}',[
        'uses'=>'ProductController@deletePhoto',
        'as' => 'deletephoto.page'
    ]);
Route::get('/admin/delete-video/{id}',[
    'uses'=>'ProductController@deleteVideo'
]);
    //Attribute
    Route::match(['get', 'post'],'/admin/add-attribute/{id}',[
        'uses'=>'ProductController@addAttribute',
        'as' => 'addattribute.page'
    ]);
    Route::match(['get', 'post'],'/admin/add-images/{id}',[
        'uses'=>'ProductController@addProductImages',
        'as' => 'addimages.page'
    ]);
    Route::get('/admin/delete-images/{id}',[
        'uses'=>'ProductController@deleteProductImages',
        'as' => 'deleteimages.page'
    ]);

    Route::get('/admin/delete-attribute/{id}',[
        'uses'=>'ProductController@deleteAttribute',
        'as' => 'deleteproductattribute.page'
    ]);
    Route::match(['get', 'post'],'/admin/edit-attribute/{id}',[
        'uses'=>'ProductController@editAttribute',
        'as' => 'editattribute.page'
    ]);
    //Coupon Route
    Route::match(['get', 'post'],'/admin/add-coupon',[
        'uses'=>'CouponController@addCoupon',
        'as' => 'addcoupon.page'
    ]);
    //edit coupon
    Route::match(['get', 'post'],'/admin/edit-coupon/{id}',[
        'uses'=>'CouponController@editCoupon',
        'as' => 'editcoupon.page'
    ]);
    //delete coupons
    Route::get('/admin/delete-coupon/{id}',[
        'uses'=>'CouponController@deleteCoupon',
        'as' => 'deletecoupon.page'
    ]);
    //view coupons
    Route::get('/admin/view-coupons',[
        'uses'=>'CouponController@viewCoupons',
        'as' => 'viewcoupon.page'
    ]);
    //order viewOrder
    Route::get('/admin/view-orders',[
        'uses'=>'ProductController@viewOrder',
        'as' => 'viewOrder'
    ]);
    //order viewOrder chart
    Route::get('/admin/view-orders-chart',[
        'uses'=>'ProductController@viewOrderChart'
    ]);
    //view ordered product
    Route::get('/admin/view-orders/{id}',[
        'uses'=>'ProductController@viewOrderProduct',
        'as' => 'viewOrderProduct'
    ]);
    //order invoice
    Route::get('/admin/view-order-invoice/{id}',[
        'uses'=>'ProductController@viewOrderInvoice',
        'as' => 'viewOrderInvoice'
    ]);
    Route::match(['get', 'post'],'/admin/order-update/{order_id}',[
        'uses'=>'ProductController@updateOrderStatus',
        'as' => 'updateOrderStatus'
    ]);
    //view user
    Route::get('/admin/view-users',[
        'uses'=>'UsersController@viewUsers',
        'as' => 'viewUsers'
    ]);
    //view users charts
    Route::get('/admin/view-users-charts',[
        'uses'=>'UsersController@viewUsersCharts'
    ]);
    //view users country
    Route::get('/admin/view-users-country-charts',[
        'uses'=>'UsersController@viewUsersCountryCharts'
    ]);
    // add cms pages
    Route::match(['get', 'post'],'/admin/add-cms-page',[
        'uses'=>'CmsController@addCmsPage'
    ]);
    //view cms page
    Route::get('/admin/view-cms-page',[
        'uses'=>'CmsController@viewCmsPage'
    ]);
    // edit cms pages
    Route::match(['get', 'post'],'/admin/edit-cms-page/{page}',[
        'uses'=>'CmsController@editCmsPage'
    ]);
    //delete cms page
    Route::get('/admin/delete-cms-page/{page}',[
        'uses'=>'CmsController@deleteCmsPage'
    ]);
    //  Banner
    Route::match(['get', 'post'],'/admin/add-banner',[
    'uses'=>'BannersController@addBanner',
        'as' => 'addbanner.page'
    ]);
    Route::get('/admin/view-banners',[
        'uses'=>'BannersController@viewBanner',
        'as' => 'viewbanner.page'
    ]);
    Route::match(['get', 'post'],'/admin/edit-banner/{id}',[
        'uses'=>'BannersController@editBanner',
        'as' => 'editbanner.page'
    ]);
    Route::get('/admin/delete-banner/{id}',[
        'uses'=>'BannersController@deleteBanner',
        'as' => 'deletebanner.page'
    ]);
    //currency
    Route::match(['get', 'post'],'/admin/add-currency',[
        'uses'=>'CurrencyController@addCurrency'
    ]);
    Route::get('/admin/view-currency',[
        'uses'=>'CurrencyController@viewCurrency'
    ]);
    Route::match(['get', 'post'],'/admin/edit-currency/{id}',[
        'uses'=>'CurrencyController@editCurrency'
    ]);
    Route::get('/admin/delete-currency/{id}',[
        'uses'=>'CurrencyController@deleteCurrency'
    ]);
    //view admins
    Route::get('admin/view-admins',[
        'uses'=>'AdminController@viewAdmin'
    ]);
    Route::match(['get', 'post'],'/admin/add-admins',[
        'uses'=>'AdminController@addAdmin'
    ]);
    Route::match(['get', 'post'],'/admin/edit-admin/{id}',[
        'uses'=>'AdminController@editAdmin'
    ]);


});

Route::get('/login-register',[
    'uses'=>'UsersController@userLoginRegister',
    'as' => 'loginregister.page'
]);
//register user
Route::post('/user-register',[
    'uses'=>'UsersController@userRegister',
    'as' => 'userregister.page'
]);
//confirm email
Route::get('/confirm/{code}',[
    'uses'=>'UsersController@confirmEmail'
]);
// user logout
Route::get('/user-logout',[
    'uses'=>'UsersController@userLogout',
    'as' => 'userlogout.page'
]);
Route::match(['get', 'post'],'/user-login',[
    'uses'=>'UsersController@userLogin',
    'as' => 'userlogin.page'
]);
Route::match(['get', 'post'],'/user-recover-password',[
    'uses'=>'UsersController@forgotPass'
]);
Route::match(['get', 'post'],'/password/resetPassword/{token}',[
    'uses'=>'UsersController@ResetPassword'
]);

Route::group(['middleware' => ['frontlogin']], function(){

    Route::match(['get', 'post'],'/user/account',[
        'uses'=>'UsersController@userAccount',
        'as' => 'useraccount.page'
    ]);
    Route::get('/get-current-pwd',[
        'uses'=>'UsersController@currentPwd'
    ]);

    Route::match(['get', 'post'],'/update-password',[
        'uses'=>'UsersController@updatePassword',
        'as' => 'updatePassword'
    ]);
    Route::match(['get', 'post'],'/wish-list',[
        'uses'=>'ProductController@wishList'
    ]);
    Route::get('/wish-list/delete/{id}',[
        'uses'=>'ProductController@deleteWishList'
    ]);
    Route::match(['get', 'post'],'/checkout',[
        'uses'=>'ProductController@checkout',
        'as' => 'checkout'
    ]);
    Route::match(['get', 'post'],'/order-review',[
        'uses'=>'ProductController@orderReview',
        'as' => 'orderReview'
    ]);
    Route::match(['get', 'post'],'/place-order',[
        'uses'=>'ProductController@placeOrder',
        'as' => 'placeOrder'
    ]);
    //thanks
    Route::get('/thanks',[
        'uses'=>'ProductController@thanks'
    ]);
    //paypal
    Route::get('/paypal',[
        'uses'=>'ProductController@paypal'
    ]);
    Route::get('/user-order',[
        'uses'=>'ProductController@userOrder'
    ]);
    //order product
    Route::get('/orders/{id}',[
        'uses'=>'ProductController@userOrderProduct'
    ]);
});

Route::get('/check-email',[
    'uses'=>'UsersController@checkEmail'
]);
Route::match(['get', 'post'],'/search',[
        'uses'=>'ProductController@productSearch',
    'as' => 'productSearch'
]);

Route::get('/searchProduct',[
    'uses'=>'ProductController@searchProduct'
]);
//product filter
Route::match(['get', 'post'],'/products/filter',[
    'uses'=>'ProductController@productFilter'
]);
Route::get('/instantSearch',[
    'uses'=>'ProductController@instantSearch'
]);

Route::get('/admin/logout',[
    'uses'=>'AdminController@logout',
    'as' => 'logout.page'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//cms page
Route::match(['get', 'post'],'/page/{url}',[
    'uses'=>'CmsController@cmsPage'
]);

//contact us page
Route::match(['get', 'post'],'/contact-us',[
    'uses'=>'CmsController@contactUs'
]);
