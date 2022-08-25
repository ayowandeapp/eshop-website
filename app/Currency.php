<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public static function getCurrencyRate($price){
        $getCurrency = Currency::where('status', 1)->get();
        foreach($getCurrency as $currency){
           /* if($currency->currency_code == 'USD'){
                $rateUSD = round($price/$currency->exchange_rate, 2);
            }elseif($currency->currency_code == 'JPY'){
                $rateJPY = round($price/$currency->exchange_rate, 2);
            }
           */
            $rate[] =$currency->currency_code.' '. round($price/$currency->exchange_rate, 2);

        }
        //return $currencyArr= array('rateUSD'=>$rateUSD, 'rateJPY'=>$rateJPY);
        return $rate;
    }
}
