<?php

namespace App\Http\Requests\UserQuestion;

use Illuminate\Foundation\Http\FormRequest;

class storeUserQuestionRequest extends FormRequest
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
			"type" => "required|string|max:250",
			"title" => "required|string|max:250",
			"question" => "required|string"			
		];
	}
}