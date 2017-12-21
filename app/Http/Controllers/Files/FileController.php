<?php

namespace App\Http\Controllers\Files;

use App\File;
use App\Http\Controllers\Controller;

class FileController extends Controller
{

	public function index() {
		return view('files.index');
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
