<?php

namespace App;

use App\Traits\HasApprovals;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{

	use SoftDeletes, HasApprovals, Notifiable;

	/**
	 * Fields that can be approved by admin
	 */
	const APPROVAL_PROPERTIES = [
		'title',
		'overview_short',
		'overview'
	];

	protected $fillable = [
		'title',
		'overview_short',
		'overview',
		'price',
		'live',
		'approved',
		'finished',
		'avatar'
	];

	/**
	 * Uniquely generate a "identifier" ID each time we are creating a files.
	 * Override parent boot method on Model.
	 */
	protected static function boot() {
		parent::boot();

		// When we are creating a file, we get an instance of this file.
		static::creating(function($file) {
			// Set a unique ID as the identifier
			$file->identifier = uniqid(true);
		});
	}

	/**
	 * When we pass a file in the URL, we want the "identifier" column in be the URL NOT the "id" of it.
	 * @return string
	 */
	public function getRouteKeyName() {
		return 'identifier';
	}


	/**
	 * Check to see if the user is an admin or the user owns this file.
	 * Also if its 'live' and 'approved'
	 * @return bool
	 */
	public function visible() {

		if (auth()->user()) {
			if ( auth()->user()->isAdmin() ) {
				return true;
			}

			if ( auth()->user()->isTheSameAs( $this->user ) ) {
				return true;
			}
		}

		return $this->live && $this->approved;
	}


	/**
	 * Merge what ever changes were made from the updated file to the old file, and just grab the "APPROVAL_PROPERTIES" fields
	 */
	public function mergeApprovalProperties() {
		$this->update(array_only($this->approvals->first()->toArray(), self::APPROVAL_PROPERTIES));
	}


	/**
	 * Delete all approvals for a particular file
	 */
	public function deleteAllApprovals() {
		$this->approvals()->delete();
	}

	/**
	 * Approve file to be visible and approve all file uploads for this file
	 */
	public function approve() {
		$this->updateToBeVisible();
		$this->approveAllUploads();
	}


	/**
	 * Approve all file uploads for a particular file.
	 */
	public function approveAllUploads() {
		$this->uploads()->update([
			'approved' => true
		]);
	}


	/**
	 * Delete unapproved uploads in the 'uploads' table if a file that has been changed, has been rejected by the admin.
	 */
	public function deleteUnapprovedUploads() {
		$this->uploads()->unapproved()->delete();
	}

	/**
	 * Update a file to be visible, or in other words, approved/live
	 */
	public function updateToBeVisible() {
		$this->update([
			'live' => true,
			'approved' => true
		]);
	}


	/**Return all files where "finished" = true in database
	 * @param Builder $builder
	 *
	 * @return mixed
	 */
	public function scopeFinished(Builder $builder) {
		return $builder->where('finished', true);
	}


	/**
	 * Return all files where "live", "approved" and "finished" are all true.
	 * @param Builder $builder
	 *
	 * @return $this
	 */
	public function scopeReadyToBeShown(Builder $builder) {
		return $builder->where('finished', true)->where('live', true)->where('approved', true);
	}


	/**
	 * Check if the file is free. (Equal to 0 in database.)
	 * @return bool
	 */
	public function isFree() {
		return $this->price < 0.01;
	}


	/**
	 * Check if the new data passed in matches the old file data.
	 * If not, then return this method as true, whci will mean this file needs approval from admin.
	 * @param array $approvalProperties
	 *
	 * @return bool
	 */
	public function needsApproval(array $approvalProperties) {
		// Check if the data being passed in is equal to the old data, if not,
		// return true, (it needs approval)
		if($this->currentPropertiesDifferToGiven($approvalProperties)) {
			return true;
		}

		// Check the 'uploads' table and see if the file that a user just uploaded to the dropbox
		// for this particular file is new (approved - false).
		// ** "unapproved" coming from 'Traits/HasApprovals'
		if($this->uploads()->unapproved()->count()) {
			return true;
		}

		// Else, return false
		return false;
	}


	/**
	 * Create an approval in approvals table referencing 'approvals' relationship.
	 * @param array $approvalProperties
	 */
	public function createApproval(array $approvalProperties) {
		$this->approvals()->create($approvalProperties);
	}

	/**
	 *  Do the current properties of this model differ to the data we are given into this method.
	 * @param array $properties
	 *
	 * @return bool
	 */
	protected function currentPropertiesDifferToGiven(array $properties) {
		return array_only($this->toArray(), self::APPROVAL_PROPERTIES) != $properties;
	}


	/**
	 * Get the user id from the file being rejected or approved by admin.
	 * @param $file
	 *
	 * @return mixed
	 */
	public function filesUser($file) {

		$userId = $file->user->id;

		$user = User::where('id', '=', $userId)->first();

		return $user;
	}


	/**
	 * Calculate the commission of a file sale.
	 * @return float|int
	 */
	public function calculateCommission() {
		return (config('marketplace.sales.commission') / 100) * $this->price;
	}


	/**
	 * Get uploaded files when user starts to download the files
	 * @return mixed
	 */
	public function getUploadList() {
		// Access the 'uploads' relationship, make sure the files are 'approved' and pluck the "path" attribute coming from 'Upload' Model
		return $this->uploads()->approved()->get()->pluck('path')->toArray();
	}

	/**
	 * Check that the sale matches the sale passed in into this method.
	 * @param Sale $sale
	 *
	 * @return mixed
	 */
	public function matchesSale(Sale $sale) {
		return $this->sales->contains($sale);
	}


	/**
	 * A file belongs to a user.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function user() {
    	return $this->belongsTo(User::class);
    }


	/**
	 * A file can have many approvals.
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
    public function approvals() {
    	return $this->hasMany(FileApproval::class);
    }


	/**
	 * A file can have many 'uploads'.
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
    public function uploads() {
    	return $this->hasMany(Upload::class);
    }


	/**
	 * A file can have many sales.
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function sales() {
		return $this->hasMany(Sale::class);
	}


	/**
	 * A file has many comments
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function comments() {
		return $this->morphMany(Comment::class, 'commentable');
	}
}
