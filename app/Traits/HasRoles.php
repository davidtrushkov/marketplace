<?php

namespace App\Traits;

use App\Role;

trait HasRoles {

	/**
	 * A user can have many roles.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function roles() {
		return $this->belongsToMany(Role::class, 'user_role');
	}


	/**
	 * Check if the current user is attached to any roles in the 'roles' table.
	 * If not, return false, else, return true.
	 * @param $role
	 *
	 * @return bool
	 */
	public function hasRole($role) {
		if (!$this->roles->contains('name', $role)) {
			return false;
		}

		return true;
	}

}