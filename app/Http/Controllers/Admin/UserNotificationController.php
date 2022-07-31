<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserNotification;
use App\Http\Resources\UserNotification\UserNotificationCollection;
use App\Http\Requests\UserNotification\storeUserNotificationRequest;
use App\Http\Requests\UserNotification\updateUserNotificationRequest;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Traits\Paginate;

class UserNotificationController extends Controller
{
use Paginate;
	public function index(Request $request)
	{
		if($request->wantsJson())
		{
            $query = UserNotification::query()->with(["user:id,first_name,last_name",'notification:id,title']);
            $userNotifications = $this->paginate($query,["id","user_id","notification_id","seen_at","created_at"]);
            return response()->json(new UserNotificationCollection($userNotifications));
		}
		return view("admin.userNotifications.index");
	}

	public function create()
	{
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.userNotifications.create");
	}

	public function store(storeUserNotificationRequest $request)
	{
		UserNotification::query()->create($request->all());
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("userNotifications.index");
	}

	public function edit($id)
	{
		$userNotification = UserNotification::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.userNotifications.edit",compact('userNotification'));
	}

	public function update(updateUserNotificationRequest $request,$id)
	{
		$userNotification = UserNotification::query()->findOrFail($id);
		$userNotification->update($request->all());
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("userNotifications.index");
	}

	public function destroy($id)
	{
		$userNotification = UserNotification::query()->findOrFail($id);
		$userNotification->delete();
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("userNotifications.index");
	}

	public function show($id)
	{
		$userNotification = UserNotification::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json($userNotification);
		}
		return view("admin.userNotifications.info",compact('userNotification'));
	}
}