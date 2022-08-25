<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Order;
use App\OrdersProduct;
use App\Product;
use App\User;
use Carbon\Carbon;
use Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data =$request->input();
            $adminCount = Admin::where(['username'=>$data['username'], 'password' =>md5($data['password']), 'status'=>'1'])->count();
            if($adminCount>0){
                $request->session()->put('adminSession', $data['username']);
                return redirect('/admin/dashboard');
            }else{
                return redirect('/admin')->with('message_error', 'Invalid Username or Password');
            }
        }
        if( $request->session()->has('adminSession')){
            return redirect('/admin/dashboard');
        }
        return view('admin.admin_login');
    }
    public function logout(Request $request)
    {
        Session::flush();
        //$request->session()->forget('adminSession');
        return redirect('/admin')->with('message_success', 'Logout Successful');
    }
    public function dashboard(Request $request)
    {
        if($request->session()->has('adminSession')){
            $totalUsers= User::count();
            $totalShop = Product::count();
            $totalOrders = OrdersProduct::count();
            $newUsers = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
            $pendingOrder = Order::where('order_status', '!=', 'completed')->count();
            $completedOrder = Order::where('order_status', 'completed')->count();
            //chart of total users this year
            $Products = Product::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();

            //users= $users->groupBy(date('m'), true);
            //echo $users; die;
            //$data = array();
            //foreach ($users as $row) {
             //   $data[] = $row;
           // }
           // $data= json_encode($data);

            $chart = Charts::database($Products, 'line', 'highcharts')->title("Monthly new Products")->elementLabel("Total Products")->dimensions(1000, 500)->responsive(false)->groupByMonth(date('Y'), true);

        return view('admin.dashboard')->with(compact('totalUsers','totalShop','totalOrders','newUsers','pendingOrder','completedOrder','chart'));
       }else{
         return redirect('/admin')->with('message_error', 'Please Login with your Credentials');
    }
    }
    public function setting()
    {
        $userDetails = Admin::where(['username'=> Session::get('adminSession'), 'status'=>1])->first();
        return view('admin.settings')->with(compact('userDetails'));
    }
    public function chkPassword(Request $request)
    {
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $userCount = Admin::where(['username'=> Session::get('adminSession'), 'status'=>1])->first();
        if($userCount->count() >0){
            if($userCount->password == md5($current_password)){
                echo "true"; die;
            }else{
                echo "false"; die;
            }

        }
    }
    public function updatePassword(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $current_password = $data['current_pwd'];
            $check_password = Admin::where(['username' => Session::get('adminSession'), 'password'=> md5($current_password), 'status'=>1])->count();

            if($check_password >0){
                $password = md5($data['new_pwd']);
                Admin::where('username', Session::get('adminSession'))->update(['password'=>$password]);
                return redirect('/admin/settings')->with('message_success', 'Password updated Successfully!');
            }else{
                return redirect('/admin/settings')->with('message_error', 'Incorrect Current Password');
                //echo "false"; die;
            }
        }
    }
    public function addAdmin(Request $request){
        if($request->isMethod('post')){
            $data= $request->all();
            $usernameCount = Admin::where('username', $data['username'])->count();
            if($usernameCount >0){
                return redirect()->back()->with('message_error', 'Username Already taken');
            }else{
                if($data['type'] == 'Admin'){
                    $addAdmin = new Admin;
                    $addAdmin->type = $data['type'];
                    $addAdmin->username = $data['username'];
                    $addAdmin->password = md5($data['password']);
                    if(empty($data['status'])){
                        $status = 0;
                    }else{
                        $status =1;
                    }
                    $addAdmin->status = $status;
                    $addAdmin->save();
                    return redirect('admin/view-admins')->with('message_success','Admin '.$data['username'].' Added Successfully');
                }else if($data['type'] == 'Sub Admin'){
                    if(empty($data['categories_access'])){
                        $data['categories_access'] = 0;
                    }
                    if(empty($data['products_access'])){
                        $data['products_access'] = 0;
                    }
                    if(empty($data['orders_access'])){
                        $data['orders_access'] = 0;
                    }
                    if(empty($data['users_access'])){
                        $data['users_access'] = 0;
                    }
                    $addAdmin = new Admin;
                    $addAdmin->type = $data['type'];
                    $addAdmin->username = $data['username'];
                    $addAdmin->password = md5($data['password']);
                    $addAdmin->categories_access = $data['categories_access'];
                    $addAdmin->products_access = $data['products_access'];
                    $addAdmin->orders_access = $data['orders_access'];
                    $addAdmin->users_access = $data['users_access'];

                    if(empty($data['status'])){
                        $status = 0;
                    }else{
                        $status =1;
                    }
                    $addAdmin->status = $status;
                    $addAdmin->save();
                    return redirect('admin/view-admins')->with('message_success','Admin '.$data['username'].' Added Successfully');
                }

            }
        }
        return view('admin.admins.add_admins');
    }
    public function viewAdmin(){
        $viewAdmins = Admin::get();
        return view('admin.admins.view_admins')->with(compact('viewAdmins'));
    }
    public function editAdmin(Request $request, $id=null){
        $viewAdmin = Admin::where('id', $id)->first();
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if(empty($data['status'])){
                $status = 0;
            }else{
                $status =1;
            }
            if($data['type'] == 'Admin'){
                    Admin::where('id', $id)->update([
                        'password'=> md5($data['password']),
                        'status'=>$status
                    ]);
                }elseif($data['type'] == 'Sub Admin'){
                    if(empty($data['categories_access'])){
                        $data['categories_access'] = 0;
                    }
                    if(empty($data['products_access'])){
                        $data['products_access'] = 0;
                    }
                    if(empty($data['orders_access'])){
                        $data['orders_access'] = 0;
                    }
                    if(empty($data['users_access'])){
                        $data['users_access'] = 0;
                    }
                    Admin::where('id', $id)->update([
                        'password'=> md5($data['password']),
                        'categories_access' => $data['categories_access'],
                        'products_access' => $data['products_access'],
                        'orders_access' => $data['orders_access'],
                        'users_access' => $data['users_access'],
                        'status'=>$status
                    ]);
            }
            return redirect('admin/view-admins')->with('message_success',$data['type']. ' '. $data['username']. ' Updated Successfully');

        }
        return view('admin.admins.edit_admin')->with(compact('viewAdmin'));
    }
}
