<?php

namespace App\Http\Requests\Account;

use App\Rules\CurrentPassword;
use Illuminate\Foundation\Http\FormRequest;

class PasswordStoreRequest extends FormRequest
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
        	'password_current' => ['required', new CurrentPassword()],
	        'password' => 'required|min:6|max:16|confirmed',
        ];
    }
}
