<?php

namespace App\Http\Controllers\Files;

use App\File;
use App\Http\Controllers\Controller;
use App\Sale;

class FileController extends Controller
{
	const PERPAGE = 4;

	public function index() {

		$files = File::with(['user', 'uploads'])->readyToBeShown()->latest()->paginate(self::PERPAGE);

		return view('files.index', compact('files'));
	}

	public function show(File $file) {

		// If the file is not visible, abort
		// -- "visible" coming from 'File' model
		if (!$file->visible()) {
			return abort(404);
		}

		$uploads = $file->uploads()->approved()->get();

		// Check and see if the file_id on the sales table = to the current file id beign shown and the 'bought_user_id' = the the current user id signed in
		// Checking to see if the currently signed in user owns the file being passed in.
		$currentUserOwnsThisFile = Sale::where('file_id', '=', $file->id)->where('bought_user_id', '=', auth()->user()->id)->count();

		return view('files.show',compact('file', 'uploads', 'currentUserOwnsThisFile'));
	}
}
