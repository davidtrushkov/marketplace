<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

	protected $guarded = [];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function commentable() {
		return $this->morphTo();
	}


	/**
	 * A comment belongs to a user.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user() {
		return $this->belongsTo(User::class);
	}


	/**
	 * A comment has many replies, and references "parent_id"
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function replies() {
		return $this->hasMany(Comment::class, 'parent_id');
	}


	/**
	 * A 'parent' comment belongs to the "parent_id".
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function parent() {
		return $this->belongsTo(Comment::class, 'parent_id');
	}

}
