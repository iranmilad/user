<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Paginate;
use App\Models\MemberList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\SubscribeAccessibility;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\MemberList\MemberListCollection;
use App\Http\Requests\MemberList\storeMemberListRequest;
use App\Http\Requests\MemberList\updateMemberListRequest;
use App\Http\Resources\UserMemberList\UserMemberListCollection;

class MemberListController extends Controller
{
    use Paginate;

	public function index(Request $request)
	{
		if($request->wantsJson())
		{
            $query = MemberList::query()->with("subscribes");
            $memberLists = $this->paginate($query,["id","title","description","created_at"]);
            return response()->json(new MemberListCollection($memberLists));
		}
		return view("admin.memberLists.index");
	}

	public function users(Request $request,$id)
	{
		if($request->wantsJson())
		{
            $query = MemberList::query()->findOrFail($id);
			$query=$query->users()->with('user:id,first_name,last_name');
            $memberLists = $this->paginate($query,["id","user_id","member_list_id","created_at"]);
            return response()->json(new UserMemberListCollection($memberLists));
		}
		return view("admin.memberLists.index");
	}

	public function create()
	{
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.memberLists.create");
	}

	public function store(storeMemberListRequest $request)
	{

        $this->sendNotification($request);    //add for send notification
		try{
			DB::beginTransaction();

			$memberList=MemberList::query()->create($request->all());

			$this->createSubscribe($request,$memberList);

			DB::commit();
			if(request()->wantsJson())
			{
                return response()->json();
			}

			return redirect()->route("memberLists.index");
		}catch(\Exception $ex){
			DB::rollBack();
			throw ValidationException::withMessages(["error"=>"خطا در ثبت اطلاعات."]);
		}
	}

	private function createSubscribe($request , $memberList){
		$subscribes=$request->input('subscribes');

		if($subscribes && is_array($subscribes)){
			foreach($subscribes as $subscribe){
				SubscribeAccessibility::create([
					"subscribe_id"=>$subscribe["id"],
					"reference_id"=>$memberList->id,
					"reference_type"=>3
				]);
			}

		}
	}

	public function edit($id)
	{
		$memberList = MemberList::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.memberLists.edit",compact('memberList'));
	}

	public function update(updateMemberListRequest $request,$id)
	{
		try{
			DB::beginTransaction();

			$memberList = MemberList::query()->findOrFail($id);
			$memberList->update($request->all());

			$memberList->subscribes()->delete();

			$this->createSubscribe($request,$memberList);

			DB::commit();

			if(request()->wantsJson())
			{
				return response()->json();
			}
			return redirect()->route("memberLists.index");
		}catch(\Exception $ex){
			DB::rollBack();
			throw ValidationException::withMessages(["error"=>"خطا در ثبت اطلاعات."]);
		}
	}

	public function destroy($id)
	{
		$memberList = MemberList::query()->findOrFail($id);
		$memberList->users()->delete();
		$memberList->delete();
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("memberLists.index");
	}

	public function destroyUser($id,$user_id)
	{
		$memberList = MemberList::query()->findOrFail($id);
		$memberList->users()->where('id',$user_id)->delete();
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("memberLists.index");
	}

	public function show($id)
	{
		$memberList = MemberList::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json($memberList);
		}
		return view("admin.memberLists.info",compact('memberList'));
	}

	public function changeSpecialUsers($id){
		$memberList = MemberList::query()->findOrFail($id);
		$memberList->special_users=!$memberList->special_users;
		$memberList->save();

		if(request()->wantsJson())
		{
			return response()->json($memberList);
		}
		return redirect()->route("memberLists.index");
	}

	public function createUser(Request $request, $id)
	{
		$memberList = MemberList::query()->findOrFail($id);
		$users=$request->input('user_id');
		$lists=$memberList->users;

		foreach($users as $user_id){
			if($lists->where('user_id',$user_id)->count()==0)
				$memberList->users()->create(['user_id'=>$user_id]);
		}

		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("memberLists.show",$id);
	}


    private function sendNotification(Request $request){

        if (!substr($request->input('title'), 0, 1)=="S") return;
        $symbol=$request->input('title');
        $levelName=$request->input('description');


        $username= env("ALERT_SYSTEM_USER") ?: "1";
        $password= env("ALERT_SYSTEM_PASS") ?: "1";
        $url= env("ALERT_SYSTEM_URL") ?: "https://alert.tseshow.com/api/config" ;


		$level= $this->getLevel($levelName,$symbol);
        if(!$level) return;
        $data=[
            "user"=>1,
            "stock"=>$symbol,
            "ex_change"=>"tsetmc",
            "type"=>$level['type']=='resistent' ? "down-to-up" : "up-to-down",
            "price"=>$level['price'],
            "price_type"=>"daily",
            "start_time"=>"09:30",
            "end_time"=>"12:30",
            "max_notification_count"=>1,
            "sended_notification_count"=>0,
            "active"=>true
        ];

        $postdata = json_encode($data);
        Log::info($postdata);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);

        //curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Basic '. base64_encode($username.":".$password)));

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch);
        curl_close($ch);
        Log::info($httpcode);
        Log::info($response);

    }

    private function getLevel($level,$isinc){

        $url= env("ALERT_FEEDER_URL")."/api/stock/technicalLevel/".$isinc ?: "https://feed.tseshow.com/api/stock/technicalLevel/".$isinc ;

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $response = curl_exec($curl);

        if(isset($response) and isset(json_decode($response,true)['data'])){
            $decoded_json = json_decode($response,true)['data'];
            curl_close($curl);
            foreach($decoded_json as $row){
                if ($row['level']==$level) {
                    Log::info($row);
                    return $row;
                }
            }
        }
        else{
            log::alert("Alert System Error");
            Log::warning($response);
        }


    }



}
