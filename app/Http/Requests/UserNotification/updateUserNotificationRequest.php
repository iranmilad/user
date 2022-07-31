<?php

namespace App\Http\Requests\UserNotification;

use Illuminate\Foundation\Http\FormRequest;

class updateUserNotificationRequest extends FormRequest
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
			"user_id" => "required",
			"notification_id" => "required",
			"seen_at" => ""
		];
	}
}