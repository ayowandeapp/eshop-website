<?php

namespace App\Http\Controllers;

use App\Country;
use App\User;
use Carbon\Carbon;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function userLoginRegister(Request $request){
        $meta_title = "User Login/Register - Ecom Website";
        return view('users.login_register')->with(compact('meta_title'));
    }
    public function userRegister(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
           // echo "<pre>"; print_r($data); die;
            $userRegister  = new User;
            $userRegister->name = $data['name'];
            $userRegister->email = $data['email'];
            $userRegister->password = bcrypt($data['password']);
            $userRegister->admin = 0;
            $userRegister->save();
            //send email
            $email = $data['email'];
            $messageData = ['email'=>$data['email'], 'name'=>$data['name'],'code'=>base64_encode($data['email'])];
            Mail::send('emails.confirmation', $messageData,function($message) use($email){
                $message->to($email)->subject('Confirm your Shopping Website email');
            });
            return redirect()->back()->with('message_success', 'Confirmation Message sent to your Email');
        }
    }
    public function userLogout(){
        Auth::logout();
        Session::forget('frontSession');
        Session::forget('session_id');
        return redirect('/');
    }
    public function checkEmail(Request $request){
        $data = $request->all();
        $emailCount= User::where('email', $data['email'])->count();
        if($emailCount >0){
            echo "false";
        }else{
            echo "true";
        }

    }
    public function forgotPass(Request $request){
        if($request->isMethod('post')){
            $data= $request->all();
            $request->validate([
                'recoverEmail' => 'required|email'
            ]);
           // echo "<pre>"; print_r($data); die;
            $user= User::where('email',$data['recoverEmail'])->first();
            if($user->count() ==0){
                return redirect()->back()->with('message_error', 'User does not Exist');
            }
            //create password token
            DB::table('password_resets')->insert([
                'email' =>$data['recoverEmail'],
                'token' =>str_random(60),
                'created_at' => Carbon::now()
            ]);
            //get the token created above
            $token = DB::table('password_resets')->where('email', $data['recoverEmail'])->first();
            $email = $token->email;
            $name= $user->name;
            $token= $token->token;
            $messageData = ['email'=>$email, 'name'=>$name,'token'=>$token];
            Mail::send('emails.reset_password', $messageData,function($message) use($email){
                $message->to($email)->subject('E-SHOPPER Reset Your Password');
            });
            return redirect()->back()->with('message_success','A reset link has been sent to your email address');

        }

        return view('users.recover_password');
    }
    public function ResetPassword(Request $request, $token=null){
        if($request->isMethod('post')){
            $data= $request->all();
            $request->validate([
                'resetPassword' => 'required|min:6|confirmed'
            ]);
            //echo "<pre>"; print_r($token); die;
            $tokenDetail = DB::table('password_resets')->where(['token'=> $token])->first();
            //echo "<pre>"; print_r($tokenDetail); die;
            $user = User::where('email', $tokenDetail->email)->first();
            if($user->count() ==0){
                return redirect('/user-recover-password')->with('message_error', 'Email does not exist');
            }
            User::where('email', $tokenDetail->email)->update(['password'=>bcrypt($data['resetPassword'])]);
            $email = $tokenDetail->email;
            $name = $user->name;

            DB::table('password_resets')->where('email', $email)->delete();
            $messageData = ['email'=>$email, 'name'=>$name];
            Mail::send('emails.reset_success', $messageData,function($message) use($email){
                $message->to($email)->subject('E-SHOPPER Reset Your Password');
            });
            return redirect('/user-login')->with('message_success', 'Password Reset, Kindly login in');

        }
        //echo "<pre>"; print_r($token); die;
        $tokenCount =DB::table('password_resets')->where('token', $token)->count();
        if($tokenCount == 0){
            return redirect('/user-login');
        }
        return view('users.reset_password')->with(compact('token'));
    }
    public function userLogin(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){
            $userStatus= User::where('email', $data['email'])->first();
                if($userStatus->status ==0){
                    return redirect()->back()->with('message_error','Your account is not Activated. Please confirm your email to Activate');
                }
                Session::put('frontSession',$data['email'] );
                if(!empty(Session::has('session_id'))){
                    $session = Session::get('session_id');
                    DB::table('cart')->where('session_id', $session)->update(['user_email'=> $data['email']]);
                }
                return redirect('/cart');
            }else{
                return redirect()->back()->with('message_error','Invalid Email Address and Password');
            }
        }
        if(Auth::check()){
            return redirect('/cart');
        }
        return view('users.login_register');
    }
    public function userAccount(Request $request){
        $user = Auth::user()->id;
        $userDetails = User::where('id',$user)->first();
       // echo "<pre>"; print_r($userDetail); die;
        $countries = Country::all();
        $countries=json_decode(json_encode($countries));
        //echo "<pre>"; print_r($countries); die;
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if(empty($data['address'])){
                $data['address'] = '';
            }
            if(empty($data['city'])){
                $data['city'] = '';
            }
            if(empty($data['state'])){
                $data['state'] = '';
            }
            if(empty($data['country'])){
                $data['country'] = '';
            }
            if(empty($data['pincode'])){
                $data['pincode'] = '';
            }
            if(empty($data['mobile'])){
                $data['mobile'] = '';
            }
            User::where('id', $user)->update(['name'=>$data['name'], 'address'=>$data['address'],'city'=>$data['city'],'state'=>$data['state'],'country'=>$data['country'],
                'pincode'=>$data['pincode'],'mobile'=> $data['mobile'] ]);
            return redirect()->back()->with('message_success','User Details Updated Successfully');

        }
        return view('users.account')->with(compact('countries', 'userDetails'));
    }
    public function currentPwd(Request $request){
        $data = $request->all();
        //echo "<pre>"; print_r($data); die;
        $user = Auth::user()->id;
        $current_password = $data['current_password'];
        $check_password = User::where('id', $user)->first();
        if(Hash::check($current_password, $check_password->password)){
            echo "true"; die;
        }else{
            echo "false"; die;
        }
    }
    public function confirmEmail($code = null){
        $email= base64_decode($code);
        $userCount = User::where('email',$email)->count();
        if($userCount >0){
            $userDetail = User::where('email',$email)->first();
            if($userDetail->status == 1){
                return redirect('login-register')->with('message_error','Account as already been Activated. Kindly Login');
            }else{
                User::where('email',$email)->update(['status'=>1]);
                //send welcome email
                $messageData = ['email'=>$email, 'name'=>$userDetail->name];
                Mail::send('emails.welcome', $messageData,function($message) use($email){
                    $message->to($email)->subject('Welcome to online Shopping');
                });
                return redirect('login-register')->with('message_success','Account as been Activated. Kindly Login');
            }

        }else{
            abort(404);
        }
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            //old pwd
            $old_pwd = User::where('id', Auth::user()->id)->first();
            $current_pwd = $data['current_password'];
            if(Hash::check($current_pwd,$old_pwd->password )){
                $new_pwd = bcrypt($data['new_pwd']);
                $new_pwd = User::where('id', Auth::user()->id)->update(['password'=> $new_pwd]);
                return redirect()->back()->with('message_success','Password updated successfully');
            }else{
                return redirect()->back()->with('message_error','Current Password is Incorrect');

            }
        }

    }
    public function viewUsers(){
        if(Session::get('adminType')['users_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        $viewUsers = User::get();
        return view('admin.users.view_users')->with(compact('viewUsers'));
    }
    public function viewUsersCharts(){
        if(Session::get('adminType')['users_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        $user = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
        $chart = Charts::database($user, 'pie', 'highcharts')->title("Monthly Users")->elementLabel("Total Users")->dimensions(1000, 500)->responsive(false)->groupByMonth(date('Y'), true);

        return view('admin.users.view_users_charts')->with(compact('chart'));
    }
    public function viewUsersCountryCharts(){
        if(Session::get('adminType')['users_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        //get the country names and the count i.e  number of times they are duplicated in the table
        $viewUsersCountry = User::select('country', DB::raw('count(country) as count'))->groupBy('country')->get();
        //$viewUsersCountry= json_decode(json_encode($viewUsersCountry));
        //echo "<pre>"; print_r($viewUsersCountry); die;
        return view('admin.users.view_users_country_charts')->with(compact('viewUsersCountry'));
    }

}
