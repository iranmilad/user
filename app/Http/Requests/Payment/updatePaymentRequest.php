<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class updatePaymentRequest extends FormRequest
{
	 /**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}
	 /**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			"gu_id" => "required|max:150",
			"user_id" => "required",
			"ref_id" => "required|max:150",
			"amount" => "required",
			"state" => "",
			"type" => ""
		];
	}
}