<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class StoreAvatarFormRequest extends FormRequest
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
	        'avatar' => 'image|max:2048'
        ];
    }

    public function messages() {
    	return [
    		'avatar.image' => 'Not a valid image.',
		    'avatar.max' => 'Maximum size of image can only be 2MB.'
	    ];
    }
}
