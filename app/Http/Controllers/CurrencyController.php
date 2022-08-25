<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
        public function addCurrency(Request $request){
            if($request->isMethod('post')){
                $data = $request->all();
                //echo '<pre>'; print_r($data); die;
                if(empty($data['status'])){
                    $status=0;
                }else{
                    $status=1;
                }
                $addCurrency = new Currency;
                $addCurrency->currency_code = $data['currency_code'];
                $addCurrency->exchange_rate = $data['exchange_rate'];
                $addCurrency->status = $status;
                $addCurrency->save();
                return redirect('admin/view-currency')->with('message_success', 'Currency Added Successfully');


            }

            return view('admin.currency.add_currency');

        }
        public function viewCurrency(){
        $viewCurrency = Currency::get();
        return view('admin.currency.view_currency')->with(compact('viewCurrency'));

    }
        public function editCurrency(Request $request, $id=null){
            $currency = Currency::where('id', $id)->first();
            if($request->isMethod('post')){
                $data = $request->all();
                if(empty($data['status'])){
                    $status=0;
                }else{
                    $status=1;
                }
                Currency::where('id', $id)->update(['currency_code'=>$data['currency_code'], 'exchange_rate'=>$data['exchange_rate'],'status'=>$status]);
                return redirect('admin/view-currency')->with('message_success', 'Currency Edited Successfully');
            }
            return view('admin.currency.edit_currency')->with(compact('currency'));
        }
        public function deleteCurrency($id=null){
            Currency::where('id', $id)->delete();
            return redirect()->back()->with('message_success', 'Currency Deleted Successfully');
        }
}
