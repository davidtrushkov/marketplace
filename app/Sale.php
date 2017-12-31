<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
    	'identifier',
	    'buyer_email',
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
	 * A Sale belongs to a file.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function file() {
		return $this->belongsTo(File::class);
	}
}
