<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class storeUserRequest extends FormRequest
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
			"first_name" => "max:150",
			"last_name" => "max:150",
			"mobile" => "max:11|unique:users,mobile",
			"email" => "max:150|unique:users,email",
			"password" => "required|max:250",
		];
	}
}