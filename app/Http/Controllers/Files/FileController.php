<?php

namespace App\Http\Controllers\Files;

use App\File;
use App\Http\Controllers\Controller;

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

		return view('files.show',compact('file', 'uploads'));
	}
}
