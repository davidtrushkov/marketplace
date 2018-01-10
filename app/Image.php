<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['path'];


	/**
	 * @return string
	 */
    public function path() {
    	return config('image.path.absolute') . $this->path;
    }


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function user() {
    	return $this->belongsTo(User::class);
    }
}
