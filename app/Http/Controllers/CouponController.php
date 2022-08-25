<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function addCoupon(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1;
            }
            $addcoupon = new Coupon;
            $addcoupon->coupon_code = $data['coupon_code'];
            $addcoupon->amount  = $data['amount'];
            $addcoupon->amount_type  = $data['amount_type'];
            $addcoupon->expiry_date  = $data['expiry_date'];
            $addcoupon->status  = $status;
            $addcoupon->save();
            return redirect('/admin/view-coupons')->with('message_success', 'Coupon Added successfully');
        }
        return view('admin.coupons.add_coupon');

    }
    public function editCoupon (Request $request ,$id= null){
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1;
            }
            Coupon::where('id', $id)->update(['coupon_code'=>$data['coupon_code'],
            'amount'=> $data['amount'], 'amount_type'=> $data['amount_type'], 'expiry_date'=>$data['expiry_date'], 'status'=>$status]);
            return redirect('/admin/view-coupons')->with('message_success', 'Coupon Edited successfully');
        }
        $couponDetail = Coupon::where('id', $id)->first();
        return view('admin.coupons.edit_coupon')->with(compact('couponDetail'));
}
    public function viewCoupons(){
        $coupons = Coupon::all();
        //$coupons = json_decode(json_encode($coupons));
        //echo "<pre>"; print_r($coupons); die;
        return view('admin.coupons.view_coupons')->with(compact('coupons'));

    }
    public function deleteCoupon($id=null){
        Coupon::where('id',$id)->delete();
        return redirect('/admin/view-coupons')->with('message_success', 'Coupon Deleted successfully');
    }

}
