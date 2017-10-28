<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{

	use SoftDeletes;

	protected $fillable = [
		'title',
		'overview_short',
		'overview',
		'price',
		'live',
		'approved',
		'finished',
	];

	/**
	 * Uniquely generate a "identifier" ID each time we are creating a files.
	 * Override parent boot method on Model.
	 */
	protected static function boot() {
		parent::boot();

		// When we are creating a file, we get an instance of this file.
		static::creating(function($file) {
			// Set a unique ID as the identifier
			$file->identifier = uniqid(true);
		});
	}

	/**
	 * When we pass a file in the URL, we want the "identifier" column in be the URL NOT the "id" of it.
	 * @return string
	 */
	public function getRouteKeyName() {
		return 'identifier';
	}


	/**Return all files where "finished" = true in database
	 * @param Builder $builder
	 *
	 * @return mixed
	 */
	public function scopeFinished(Builder $builder) {
		return $builder->where('finished', true);
	}


	/**
	 * Check if the file is free. (Equal to 0 in database.)
	 * @return bool
	 */
	public function isFree() {
		return $this->price === 0;
	}

	/**
	 * A file belongs to a user.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function user() {
    	return $this->belongsTo(User::class);
    }
}
