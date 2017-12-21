<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Http\Controllers\Controller;

class FileController extends Controller
{

	/**
	 * Show the file to admin, and show any updates made to that file if any just to admin
	 * @param File $file
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show(File $file) {

		$file = $this->replaceFilePropertiesWithUnapprovedChanges($file);

		return view('files.show',[
			'file' => $file,
			'uploads' => $file->uploads
		]);
	}


	/**
	 * Get the unapproved changes made to the file
	 * @param File $file
	 *
	 * @return File
	 */
	protected function replaceFilePropertiesWithUnapprovedChanges(File $file) {
		if ($file->approvals->count()) {
			$file->fill($file->approvals->first()->toArray());
		}

		return $file;
	}
}
