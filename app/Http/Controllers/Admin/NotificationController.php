<?php

namespace App\Http\Controllers\Admin;

use App\Constants\NotificationTypes;
use App\Models\Notification;
use App\Http\Resources\Notification\NotificationCollection;
use App\Http\Requests\Notification\storeNotificationRequest;
use App\Http\Requests\Notification\updateNotificationRequest;
use App\Models\User;
use App\Models\UserNotification;
use App\Traits\Notification\Notification as NotificationTrait;
use Illuminate\Http\Request;
use App\Traits\Paginate;

class NotificationController extends Controller
{
	use Paginate ,NotificationTrait;
	public function index(Request $request)
	{
		if($request->wantsJson())
		{
            $query = Notification::query();
            $notifications = $this->paginate($query,["id","title","text","type","created_at"]);
            return response()->json(new NotificationCollection($notifications));
		}
		return view("admin.notifications.index");
	}

	public function create()
	{
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.notifications.create");
	}

	public function store(storeNotificationRequest $request)
	{
		$this->createNotification($request);
		
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("notifications.index");
	}

	public function edit($id)
	{
		$notification = Notification::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.notifications.edit",compact('notification'));
	}

	public function update(updateNotificationRequest $request,$id)
	{
		$notification = Notification::query()->findOrFail($id);
		$notification->update($request->all());
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("notifications.index");
	}

	public function destroy($id)
	{
		$notification = Notification::query()->findOrFail($id);
		$notification->delete();
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("notifications.index");
	}

	public function show($id)
	{
		$notification = Notification::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json($notification);
		}
		return view("admin.notifications.info",compact('notification'));
	}
}