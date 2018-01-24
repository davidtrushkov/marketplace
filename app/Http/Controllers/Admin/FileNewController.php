<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Notifications\FileRejected;
use App\Notifications\FileApproved;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notifiable;

class FileNewController extends Controller
{

	use Notifiable;


	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index() {

		// Get all the files that are "unapproved", 'finished' = true, and get the oldest ones first
		// -- 'unapproved' coming from "HasApprovals" trait, and is a scope
		// -- 'finished' coming from "File" model, and is a scope
		$files = File::unapproved()->finished()->oldest()->get();

		return view('admin.files.new.index', compact('files'));
	}


	/**
	 * Approve the file and send email to user that it has been approved.
	 * @param File $file
	 *
	 * @return mixed
	 */
	public function update(File $file) {

		// Approve a file with its uploads.
		// -- 'approve' coming from "File" model
		$file->approve();

		// Get the user associated with this file approval
		$user = $file->filesUser($file);

		// Send an email to the user notifying them that their file has been approved.
		$user->notify(new FileApproved($user, $file));

		return back()->withSuccess("{$file->title} has been approved");
	}


	/**
	 * Show new file rejection page for admin to send notification to user of rejection.
	 * @param $identifier
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function newFileRejectionNotification($identifier) {

		// Get the file
		$file = File::where('identifier', $identifier)->first();

		return view('admin.files.new.rejection', compact('file'));
	}


	/**
	 * Destroy a file with its uploads and send email and notification to user.
	 * @param File $file
	 *
	 * @return mixed
	 */
	public function destroy (File $file) {

		// Get the rejection message from admin
		$data = request('data');

		// Delete the main file
		$file->delete();

		// Delete all of the main files uploads
		$file->uploads->each->delete();

		// Get the user associated with this file rejection
		$user = $file->filesUser($file);

		// Send an email to the user notifying them that their file has been rejected and a database notification.
		$user->notify(new FileRejected($user, $file, $data));

		return redirect(route('admin.files.new.index'))->withSuccess("{$file->title} has been rejected and notification sent to user");
	}
}
