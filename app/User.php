<?php

namespace App;

use App\Traits\HasRoles;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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
        'name', 'email', 'password', 'verified', 'token', 'stripe_id', 'stripe_key', 'avatar'
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
	 * A user has one avatar image.
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function avatar() {
		return $this->hasOne(Image::class, 'id', 'avatar_id');
	}


	/**
	 * Return an avatar path.
	 * @return null
	 */
	public function avatarPath() {
		// Check to see if users avatar doesn't exist.
		if (!$this->avatar_id) {
			return null;
		}

		// Use a path helper called 'path' located on Image model.
		return $this->avatar->path();
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


	/**
	 * Get a currently signed in users sales sum overall.
	 * @return mixed
	 */
	public function saleValueOverLifetime() {
		return $this->sales->sum('sale_price');
	}


	/**
	 * Grab the sales for month from now, and get users sales.
	 * @return mixed
	 */
	public function saleValueThisMonth() {

		// Grab the date right now.
		$now = Carbon::now();

		return $this->sales()->whereBetween('created_at', [
			$now->startOfMonth(),
			$now->copy()->endOfMonth()
		])->get()->sum('sale_price');
	}
}
