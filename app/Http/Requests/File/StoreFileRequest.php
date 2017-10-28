<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
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
            'title'             => 'required|max:255',
	        'overview_short'    => 'required|max:300',
	        'overview'          => 'required',
	        'price'             => 'required|numeric'
        ];
    }

    public function messages() {
    	return [
    		'title.required'          => 'The file title is required',
		    'title.max'               => 'The title can\'t be more than 255 characters',
		    'overview_short.required' => 'The short overview is required',
		    'overview_short.max'      => 'The short overview can\'t be more than 300 characters',
		    'overview.required'       => 'The overview is required',
		    'price.required'          => 'The price field is required',
		    'price.numeric'           => 'The price must be a numeric value',
	    ];
    }
}
