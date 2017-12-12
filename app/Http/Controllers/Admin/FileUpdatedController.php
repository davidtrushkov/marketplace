<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Http\Controllers\Controller;
use App\Notifications\UpdatedFileApproved;
use App\Notifications\UpdatedFileRejection;

class FileUpdatedController extends Controller
{


	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index() {

		// Get all the files where it has 'approvals', and get the oldest ones
		// So get all the files that need approvals (have been updated)
		$files = File::whereHas('approvals')->oldest()->get();

		return view('admin.files.updated.index', compact('files'));
	}


	/**
	 * Approve changes to a file and its uploads.
	 * @param File $file
	 *
	 * @return mixed
	 */
	public function update(File $file) {

		// merge approval properties
		// -- 'mergeApprovalProperties' coming from "File" model
		$file->mergeApprovalProperties();

		// approve all uploads
		// -- 'approveAllUploads' coming from "File" model
		$file->approveAllUploads();

		// delete all approvals
		// -- 'deleteAllApprovals' coming from "File" model
		$file->deleteAllApprovals();

		// Get the user associated with this file updated approval
		$user = $file->filesUser($file);

		// Send an email to the user notifying them that their file has been approved.
		$user->notify(new UpdatedFileApproved($user, $file));

		return back()->withSuccess("{$file->title} changes have been approved");
	}


	/**
	 * Reject a file with its uploads.
	 * @param File $file
	 *
	 * @return mixed
	 */
	public function destroy(File $file) {

		// delete all approvals
		$file->deleteAllApprovals();

		// Delete all unapproved uploads
		$file->deleteUnapprovedUploads();

		// Get the user associated with this file updated rejection
		$user = $file->filesUser($file);

		// Send an email to the user notifying them that their updated file has been rejected.
		$user->notify(new UpdatedFileRejection($user, $file));

		return back()->withSuccess("{$file->title} changes have been rejected");
	}
}
