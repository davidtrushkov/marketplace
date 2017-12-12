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
	 * Destroy a file with its uploads
	 * @param File $file
	 *
	 * @return mixed
	 */
	public function destroy (File $file) {

		// Delete the main file
		$file->delete();

		// Delete all of the main files uploads
		$file->uploads->each->delete();

		// Get the user associated with this file rejection
		$user = $file->filesUser($file);

		// Send an email to the user notifying them that their file has been rejected.
		$user->notify(new FileRejected($user, $file));

		return back()->withSuccess("{$file->title} has been rejected");
	}
}
