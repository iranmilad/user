<?php


namespace App\Constants;


class NotificationTypes
{
    const PUBLIC = 1;
    const PRIVATE = 2;
    const SPESIALS = 3;
    const NON_SPESIALS = 4;
    const MEMBER_LIST = 5;

    public static function aliases($type = null)
    {
        $arr = ['','همه کاربران','کاربران انتخابی','کاربران ویژه','کاربران عادی','کاربران ممبر لیست'];

        return $type!=null ? $arr[$type] : $arr;
    }
}
