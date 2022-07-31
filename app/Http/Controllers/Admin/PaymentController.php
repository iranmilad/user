<?php

namespace App\Http\Controllers\Admin;

use App\Constants\PaymentStates;
use App\Models\Payment;
use App\Http\Resources\Payment\PaymentCollection;
use App\Http\Requests\Payment\storePaymentRequest;
use App\Http\Requests\Payment\updatePaymentRequest;
use Illuminate\Http\Request;
use App\Traits\Paginate;

class PaymentController extends Controller
{
use Paginate;
	public function index(Request $request)
	{
		if($request->wantsJson())
		{
            $query = Payment::query()->with('user:id,first_name,last_name')->where("state",">",PaymentStates::PENDING);
            $payments = $this->paginate($query,["id","user_id","ref_id","amount","state","type","created_at"]);
            return response()->json(new PaymentCollection($payments));
		}
		return view("admin.payments.index");
	}

	public function create()
	{
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.payments.create");
	}

	public function store(storePaymentRequest $request)
	{
		Payment::query()->create($request->all());
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("payments.index");
	}

	public function edit($id)
	{
		$payment = Payment::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return view("admin.payments.edit",compact('payment'));
	}

	public function update(updatePaymentRequest $request,$id)
	{
		$payment = Payment::query()->findOrFail($id);
		$payment->update($request->all());
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("payments.index");
	}

	public function destroy($id)
	{
		$payment = Payment::query()->findOrFail($id);
		$payment->delete();
		if(request()->wantsJson())
		{
			return response()->json();
		}
		return redirect()->route("payments.index");
	}

	public function show($id)
	{
		$payment = Payment::query()->findOrFail($id);
		if(request()->wantsJson())
		{
			return response()->json($payment);
		}
		return view("admin.payments.info",compact('payment'));
	}
}