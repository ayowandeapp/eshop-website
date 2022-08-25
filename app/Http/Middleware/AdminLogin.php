<?php

namespace App\Http\Middleware;

use App\Admin;
use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty(Session::has('adminSession'))) {
            return redirect('/admin');
        }else{
            //check admin type
            $adminType= Admin::where('username',Session::get('adminSession'))->first();
            //echo  $adminType = json_decode(json_encode($adminType)); die;
            if($adminType->type == 'Admin'){
                //change some of the returned variable
                $adminType->categories_access = 1;
                $adminType->products_access = 1;
                $adminType->orders_access = 1;
                $adminType->users_access = 1;
            }
            //put details in session
            Session::put('adminType', $adminType);
            //get the current url
            $currentPath = Route::getFacadeRoot()->current()->uri();
            // if($currentPath == 'admin/add-product' || $currentPath == 'admin/view-products' && $adminType->products_access == '0'){
            //     return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
            // }
            // if($currentPath == 'admin/add-category' || $currentPath == 'admin/view-category' && $adminType->categories_access == '0'){
            //     return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
            // }
            // if($currentPath == 'admin/view-orders' || $currentPath == 'admin/view-orders-chart' && $adminType->orders_access == '0'){
            //     return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
            // }
            // if($currentPath == 'admin/view-users' || $currentPath == '/admin/view-users-charts' && $adminType->users_access == '0'){
            //     return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
            // }
        }
        return $next($request);
    }
}
