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
	        'avatar'            => 'nullable|mimes:jpeg,jpg,png|max:1024',
            'title'             => 'required|max:100',
	        'overview_short'    => 'required|max:300',
	        'overview'          => 'required',
	        'price'             => 'required|numeric',
	        'youtube_url'       => 'url|nullable',
	        'vimeo_url'       => 'url|nullable',
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
    		'avatar.max'              => 'The cover image may not be greater than 1MB (1024 kilobytes).',
    		'title.required'          => 'The file title is required',
		    'title.max'               => 'The title can\'t be more than 100 characters',
		    'overview_short.required' => 'The short overview is required',
		    'overview_short.max'      => 'The short overview can\'t be more than 300 characters',
		    'overview.required'       => 'The overview is required',
		    'price.required'          => 'The price field is required',
		    'price.numeric'           => 'The price must be a numeric value',
		    'uploads.exists'          => 'Please upload atleast one file',
		    'youtube_url.url'         => 'The Youtube URL format is invalid.'
	    ];
    }
}
