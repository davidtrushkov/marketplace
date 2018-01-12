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


	/**
	 * Access the full path of a filename
	 * @return string
	 */
	public function getPathAttribute() {
		return storage_path('app/files/' . $this->file->identifier . '/' . $this->filename);
	}


	/**
	 * Convert file size into readable names.
	 * @param $size
	 * @param int $precision
	 *
	 * @return int|string
	 */
	public static function formatBytes($size, $precision = 2) {
		if ($size > 0) {
			$size = (int) $size;
			$base = log($size) / log(1024);
			$suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

			return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
		} else {
			return $size;
		}
	}

}
