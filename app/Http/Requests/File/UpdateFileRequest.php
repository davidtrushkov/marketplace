<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFileRequest extends StoreFileRequest
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

	public function rules()
	{
		return array_merge(parent::rules(), [
			'live' => ''
		]);
	}

	public function messages() {
		return parent::messages();
	}
}
