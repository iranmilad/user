<?php


namespace App\Constants;


class PaymentTypes
{
    const subscription = 1;

    public static function aliases($type = null)
    {
        $arr = ['','خرید اشتراک'];

        return $type!=null ? $arr[$type] : $arr;
    }
}
