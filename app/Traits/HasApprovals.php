<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasApprovals {


	public function scopeApproved(Builder $builder) {
		return $builder->where('approved', true);
	}


	public function scopeUnapproved(Builder $builder) {
		return $builder->where('approved', false);
	}
}