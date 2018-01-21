<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
    	'identifier',
	    'buyer_email',
	    'bought_user_id',
	    'sale_price',
	    'sale_commission'
    ];


	/**
	 * @return string
	 */
    public function getRouteKeyName() {
	    return 'identifier';
    }


	/**
	 * A Sale belongs to a user.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function user() {
    	return $this->belongsTo(User::class);
    }


	/**
	 * Get the relationship of user who bought file for a particular Sale.
	 *  -- References "id" on user table, and "bought_user_id" on sales table.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function boughtUser() {
		return $this->hasMany(User::class, 'id','bought_user_id');
	}


	/**
	 * A Sale belongs to a file.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function file() {
		return $this->belongsTo(File::class);
	}


	/**
	 * Get the user where the 'bought_user_id' is the currently signed in user.
	 * @param Builder $builder
	 *
	 * @return $this
	 */
	public function scopeBoughtUserId(Builder $builder) {
		return $builder->where('bought_user_id', '=', auth()->user()->id);
	}


	/**
	 * Sum up all the sales commissions.
	 * @return mixed
	 */
	public static function lifetimeCommission() {
		return static::get()->sum('sale_commission');
	}


	/** Grab the sales for month from now, and get all sales.
	 * @return mixed
	 */
	public static function commissionThisMonth() {
		$now = Carbon::now();

		return static::whereBetween('created_at', [
			$now->startOfMonth(),
			$now->copy()->endOfMonth()
		])->get()->sum('sale_commission');
	}
}
