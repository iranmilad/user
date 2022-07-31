<?php

namespace App\Http\Controllers;

use App\Models\Payment;

class PaymentController extends Controller
{
	public function index()
	{
		$payments=Payment::query()->paginate(15,["id","gu_id","user_id","ref_id","amount","state","type"]);
		if(request()->wantsJson())
		{		
			return response()->json($payments);
		}
		return view("payments.index",compact('payments'));
	}
}