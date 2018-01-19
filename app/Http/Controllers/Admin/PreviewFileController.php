<?php

namespace App\Http\Controllers\Admin;

use App\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PreviewFileController extends Controller {

	/**
	 * Let admin "preview" a file before approval or rejection of file.
	 *
	 * @param Request $request
	 * @param File $file
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
	 */
	public function show( Request $request, File $file ) {

		if ( ! $file->visible() ) {
			return abort( 404 );
		}

		$fileUploads = $file->uploads()->withoutPreviewFiles()->latest()->get();

		$uploadPreviews = $file->uploads()->withPreviewFiles()->latest()->get();

		$updatedChanges = $approvals = $file->approvals->first();

		return view( 'admin.previews.index', compact('file', 'fileUploads', 'uploadPreviews', 'updatedChanges'));
	}

}