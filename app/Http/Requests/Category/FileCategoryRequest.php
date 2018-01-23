<?php

namespace App\Http\Requests\Category;

use App\Category;
use Illuminate\Foundation\Http\FormRequest;

class FileCategoryRequest extends FormRequest
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
		$category = Category::find($this->id);

		return [
			'name' => 'required|string|max:25|unique:categories,name,'.$category->id,
		];
	}
}
