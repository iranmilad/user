<?php

namespace App\Http\Controllers;

use App\Http\Resources\Chart\UserChartResource;
use App\Http\Resources\Menu\UserMenuResource;
use App\Http\Resources\User\UserResource;
use App\Models\Chart;
use App\Models\Faq;
use App\Models\Menu;
use stdClass;

class HomeController extends Controller
{
	public function index()
	{
		$menus=UserMenuResource::collection(Menu::query()->get(["id","title","key"]));
		$chartAndTables=UserChartResource::collection(Chart::query()->get(["id","title","key","refresh_time","feeder_url"]));

		$data=new stdClass();
		$data->menus=$menus;
		$data->chartAndtables=$chartAndTables;
        $data->public_message=[
            ["title"=>"تایتل پیام عمومی","body"=>"متن پیام عمومی","link"=>"https://news.tseshow.com"],
            ["title"=>"2 تایتل پیام عمومی","body"=>"2 متن پیام عمومی","link"=>"https://news.tseshow.com"],

        ];
        $data->subscribes=[
            "اشتراک برای عموم رایگان می باشد "
        ];

        $data->plans=[
           ["title"=>"اشتراک برای عموم رایگان می باشد ","price"=>"0","price_monthly"=>"30000","price_discount"=>"","time"=>"30","payment_link"=>"https://payment.tseshow.com/123"],
       //     ["title"=>"اشتراک سه ماهه","price"=>"0","price_monthly"=>"30000","price_discount"=>"80000","time"=>"90","payment_link"=>"https://payment.tseshow.com/123"],
         //   ["title"=>"اشتراک شش ماهه","price"=>"180000","price_monthly"=>"30000","price_discount"=>"150000","time"=>"180","payment_link"=>"https://payment.tseshow.com/123"],
           // ["title"=>"اشتراک یک ساله","price"=>"360000","price_monthly"=>"30000","price_discount"=>"300000","time"=>"365","payment_link"=>"https://payment.tseshow.com/123"],
        ];

		$data->profile=auth()->check() ? new UserResource(auth()->user()) : null;

			// if(request()->wantsJson()){
			return response()->json($data);
		// }
	}

}


