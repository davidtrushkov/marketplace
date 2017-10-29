<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileApproval extends Model
{

	use SoftDeletes;

	protected $table = 'file_approvals';

	protected $fillable = [
		'title',
		'overview_short',
		'overview'
	];


	/**
	 * When we create a new file approval, ()when we update a file),
	 * delete all existing file approvals for particular file.
	 */
	protected static function boot() {
		parent::boot();

		// When we are creating a new file approval
		// go into the file approvals, and delete each one.
		static::creating(function ($approval) {
			$approval->file->approvals->each->delete();
		});
	}


	/**
	 * An approval belongs to a file.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function file() {
    	return $this->belongsTo(File::class);
    }
}
