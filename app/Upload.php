<?php

namespace App;

use App\Traits\HasApprovals;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{

    use SoftDeletes, HasApprovals;

	protected $fillable = [
		'filename',
		'size',
		'approved'
	];


	/**
	 * An upload belongs to a file.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function file() {
		return $this->belongsTo(File::class);
	}


	/**
	 * An upload belongs to a user.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user() {
		return $this->belongsTo(User::class);
	}
}
