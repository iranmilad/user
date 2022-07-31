<?php

namespace App\Http\Requests\Chart;

use Illuminate\Foundation\Http\FormRequest;

class storeChartRequest extends FormRequest
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
			"title" => "required|max:150",
			"key" => "required|max:150|unique:charts,key",
			"refresh_time" => "required|numeric|max:1000000",
			"feeder_url" => "max:250"
		];
	}
}