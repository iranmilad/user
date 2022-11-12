<?php

namespace App\Http\Controllers;

use App\Models\MemberList;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests\Notification\storeNotificationRequest;
use App\Http\Resources\UserMemberList\UserMemberListResource;
use App\Traits\Notification\Notification as NotificationTrait;

class NotificationController extends Controller
{
	use NotificationTrait;

	public function push(storeNotificationRequest $request)
	{

		$this->createNotification($request);

		if(request()->wantsJson())
		{

			return $this->responseJson("نوتیفیکیشن با موفقیت ارسال شد.",null,201);
		}
		return view("notifications.index",compact('notifications'));
	}

	public function alertNotification(Request $request)
	{


        $symbols = Redis::get('TradeLastDay:last');
        $allKeys = Redis::get('*');
        Log::info($allKeys);

        $symbols =json_decode( $symbols,true) ?: [];
        $memberLists=MemberList::query()->get(["id","title","description"]);
        $memberLists=UserMemberListResource::collection($memberLists);

        #return $this->responseJson("نوتیفیکیشن با موفقیت دریافت شد",$memberLists,201);
        $datas=$request->input('data');

        $req=new \App\Http\Requests\Notification\storeNotificationRequest();
        foreach($datas as $data){
            foreach([1,2,4] as $market){

                if(isset($symbols[$market][$data["symbol"]])){
                    $symbol= $symbols[$market][$data["symbol"]];
                    $label = $symbol["LVal18AFC"];
                    $type = $data["type"]=='up-to-down' ? 'شکست مقاومت': 'شکست خط حمایت';
                    $price =  $data["price"];
                    $message = $type ." بر روی نماد ". $label." در قیمت ".$price;

                    $req['type']=5;
                    foreach($memberLists as $member){
                        $req['member_list_id']=$member["id"];
                        $req['title']= " سیگنال نماد ".$label;
                        $req['text']= $message;
                        $this->createNotification($req);
                    }
                }

            }
        }




        return $this->responseJson("نوتیفیکیشن با موفقیت دریافت شد",null,201);

	}


}
