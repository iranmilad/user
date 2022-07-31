<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class confirmRegisterUserRequest  extends FormRequest
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
			"gu_id" => "required|string|max:150",
			"code" => "required|digits:4"		
		];
	}
}