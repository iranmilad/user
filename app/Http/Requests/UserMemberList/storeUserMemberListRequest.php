<?php

namespace App\Http\Requests\UserMemberList;

use Illuminate\Foundation\Http\FormRequest;

class storeUserMemberListRequest extends FormRequest
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
			"user_id" => "requiredif:user_ids|numeric|exists:users,id",
			"member_list_id" => "required|numeric|exists:memberr_lists,id"
		];
	}
}