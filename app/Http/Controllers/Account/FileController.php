<?php

namespace App\Http\Controllers\Account;

use App\File;
use App\Http\Requests\File\StoreFileRequest;
use App\Http\Controllers\Controller;

class FileController extends Controller
{


	public function index() {

		// Grab all the users files that are 'finished'
		$files = auth()->user()->files()->latest()->finished()->get();

		return view('account.files.index', compact('files'));
	}


	/**
	 * Take user to the 'create' file page if they don't have one, and do authorization checking
	 * @param File $file
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 */
	public function create(File $file) {

		// If the file we passed in doesn't exist
		if (!$file->exists) {
			// Then create a 'skeletion' file,
			// and redirect where that files does exist.
			$file = $this->createAndReturnSkeletionFile();

			// Redirect to the files create page with the files we created above
			return redirect()->route('account.files.create', $file);
		}

		// Check if the file we are dealing with belongs to the currently signed in user.
		// Use the "authorize" method and pass in the method "touch" we are using inside
		// the 'app/Polices/FilePolicy' directory.
		$this->authorize('touch', $file);

		return view('account.files.create', compact('file'));

	}


	/**
	 * Update the file in database
	 * @param File $file
	 * @param StoreFileRequest $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(File $file, StoreFileRequest $request) {

		// Make sure the user owns the file before we store it in database.
		$this->authorize('touch', $file);

		// Update the fields that we 'only' need
		$file->fill($request->only(['title', 'overview', 'overview_short', 'price']));

		// Set "finished" to true in database
		$file->finished = true;

		$file->save();

		return redirect()->route('account.files.index')
			->withSuccess('Your file has been submitted for review.');
	}


	/**
	 * Get the current user, and create a file with relationship
	 * @return mixed
	 */
	protected function createAndReturnSkeletionFile() {
		return auth()->user()->files()->create([
			'title' => 'Untitled',
			'overview_short' => 'None',
			'overview' => 'none',
			'price' => 0,
			'finished' => false
		]);
	}
}
