<?php

namespace App;

use App\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verified', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


	/**
	 * Make a boot function to listen
	 * to any model events that are fired below.
	 */
	public static function boot() {

		// Reference the parent class
		parent::boot();

		// When we are creating a record (for user registration),
		// then we want to set a token to some random string.
		static::creating(function ($user) {
			$user->token = str_random(30);
		});
	}


	/**
	 * Confirm the users email by
	 * setting verified to true,
	 * token to a NULL value,
	 * then save the results.
	 */
	public function confirmEmail() {
		$this->verified = true;
		$this->token = null;
		$this->save();
	}


	/**
	 * Check and see if the token field is NULL
	 *
	 * @return bool
	 */
	public function isVerified() {
		if ($this->token !== null) {
			return true;
		}
	}


	/**
	 * A user has many files
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
    public function files() {
    	return $this->hasMany(File::class);
    }


	/**
	 * A user can have many sales.
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function sales() {
		return $this->hasMany(Sale::class);
	}

	/**
	 * Check if user is admin.
	 */
    public function isAdmin() {
	    $this->hasRole('admin');
    }


	/**
	 * Check to see if the user is the same as the user passed in.
	 * @param User $user
	 *
	 * @return bool
	 */
	public function isTheSameAs(User $user) {
		return $this->id === $user->id;
	}
}
