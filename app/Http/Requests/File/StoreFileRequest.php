<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
	 * @return array
	 */
    protected function validationData() {

    	$this->merge(['uploads' => $this->file->id]);

    	return $this->all();
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
	        'price'             => 'required|numeric',
	        // Create a custom rule for if the "file_id" exists on the uploads table with the 'file_id'
	        // we are passing in, and also that the row with the 'file_id' is = to NULl for deleted_at column
	        // If it is, make it required
	         'uploads'           => [
	        	'required',
		        Rule::exists('uploads', 'file_id')->where(function ($query) {
		        	$query->whereNull('deleted_at');
		        })
	        ]
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
		    'uploads.exists'          => 'Please upload atleast one file'
	    ];
    }
}
