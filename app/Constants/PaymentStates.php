<?php


namespace App\Constants;


class PaymentStates
{
    const PENDING = 0;
    const SUCCESS = 1;
    const CANCELED = 2;
    const ERROR = 3;
    const PENDING_ACCEPT = 4;

    public static function aliases($state=null)
    {
        $arr= ['در انتظار پرداخت','تراکنش موفق','انصراف از پرداخت','خطا در انجام تراکنش','در انتظار تایید'];

        return (string)$state!=null ? $arr[$state] : $arr;
    }
    public static function colors()
    {
        return ['#61cbff','#00ff00','#ffad44','#ff7575','#44ffee'];
    }
}
