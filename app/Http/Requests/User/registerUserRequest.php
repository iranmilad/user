<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class registerUserRequest extends FormRequest
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
			"first_name" => "string|max:150",
			"last_name" => "required|string|max:150",
			"mobile" => "required|size:11|unique:users,mobile",
			"email" => "max:150|unique:users,email",
			"password" => "required|min:8|max:250", //|confirmed
		];
	}
}