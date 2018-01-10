<?php

namespace App\Http\Requests\Account;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateSettingsRequest extends FormRequest
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
	public function rules(Request $request)
	{

		$user = auth()->user();

		return [
//			'avatar_id' => [
//				'nullable',
//				Rule::exists('images', 'id')->where(function($q) use ($request) {
//					$q->where('user_id', $request->user()->id);
//				})
//			],
			'name' => 'required|string|max:25|unique:users,name,'.$user->id,
		];
	}
}
