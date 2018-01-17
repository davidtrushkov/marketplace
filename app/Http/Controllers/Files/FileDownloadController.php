<?php

namespace App\Http\Controllers\Files;

use App\File;
use App\Sale;
use Chumper\Zipper\Zipper;
use App\Http\Controllers\Controller;

class FileDownloadController extends Controller
{

	/**
	 * @var Zipper
	 */
	protected $zipper;


	/**
	 * FileDownloadController constructor.
	 *
	 * @param Zipper $zipper
	 */
	public function __construct(Zipper $zipper) {
		$this->zipper = $zipper;
	}


	/**
	 * Check for errors and permissions, create and zip the files and download them.
	 * @param File $file
	 * @param Sale $sale
	 *
	 * @return $this|void
	 */
	public function show(File $file, Sale $sale) {

		// Check if the file is 'live' and 'approved' from database.
		// -- "visible" coming from 'File' model
		if ( ! $file->visible() ) {
			return abort( 403 );
		}

		// Check if the sale matches the sale passed in
		// -- "matchesSale" coming from 'File' model
		if ( ! $file->matchesSale( $sale ) ) {
			return abort( 403 );
		}

		// Zip the files
		$this->createZipForFileInPath($file, $path = $this->generateTemporaryPath($file));

		// Download the files, and delete the files from the 'temp' directory after download has completed.
		return response()->download($path)->deleteFileAfterSend(true);
	}


	/**
	 * Download files for admin to preview them.
	 *
	 * @param File $file
	 *
	 * @return $this|\Illuminate\Http\RedirectResponse|void
	 */
	public function adminDownload(File $file) {

		if (auth()->user() && auth()->user()->hasRole('admin')) {

			// Check if the file is 'live' and 'approved' from database.
			// -- "visible" coming from 'File' model
			if ( ! $file->visible() ) {
				return abort( 403 );
			}

			// Zip the files
			$this->createZipForFileInPath( $file, $path = $this->generateTemporaryPath( $file ) );

			// Download the files, and delete the files from the 'temp' directory after download has completed.
			return response()->download( $path )->deleteFileAfterSend( true );
		} else {
			return back();
		}
	}


	/**
	 * @param File $file
	 * @param $path
	 */
	protected function createZipForFileInPath(File $file, $path) {
		$this->zipper->make($path)->add($file->getUploadList())->close();
	}


	/**
	 * Generate the temporary path
	 * @param File $file
	 *
	 * @return string
	 */
	protected function generateTemporaryPath(File $file)
	{
		return public_path('tmp/' . str_slug($file->title) . '.zip');
	}

}
