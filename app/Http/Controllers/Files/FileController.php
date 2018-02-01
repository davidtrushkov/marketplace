<?php

namespace App\Http\Controllers\Files;

use App\File;
use App\Sale;
use App\Comment;
use App\Category;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class FileController extends Controller  {

	const PERPAGE = 15;


	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index() {

		$categories = Category::orderBy('name', 'asc')->get();

		switch (request('filter')) {
			case 'newest-files':
				$files = File::with(['user', 'uploads'])->readyToBeShown()->latest()->paginate(self::PERPAGE);
				break;
			case 'oldest-files':
				$files = File::with(['user', 'uploads'])->readyToBeShown()->oldest()->paginate(self::PERPAGE);
				break;
			case 'price-low':
				$files = File::with(['user', 'uploads'])->readyToBeShown()->orderBy('price', 'asc')->latest()->paginate(self::PERPAGE);
				break;
			case 'price-high':
				$files = File::with(['user', 'uploads'])->readyToBeShown()->orderBy('price', 'desc')->latest()->paginate(self::PERPAGE);
				break;
			case 'most-sales':
				$tableValues = \Schema::getColumnListing('files');
				$string = 'files.';

				foreach($tableValues as $value) {
					$attributes[] = $string.$value;
				}

				$files = File::leftJoin('sales', 'sales.file_id', '=', 'files.id')
					->select(DB::raw('files.*, count(sales.id) AS count'))
					->groupBy($attributes)->orderBy('count', 'desc')->readyToBeShown()->paginate(self::PERPAGE);

				break;
			case 'with_videos':
				$files = File::with(['user', 'uploads'])->readyToBeShown()->where('youtube_url', '!=', null)->orWhere('vimeo_url', '!=', null)->latest()->paginate(self::PERPAGE);
				break;
			default;
				$files = File::with(['user', 'uploads'])->readyToBeShown()->latest()->paginate(self::PERPAGE);
				break;
		}

		return view('files.index', compact('files', 'categories'));
	}


	/**
	 * @param $slug
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getFilesByCategory($slug) {

		// Get the category that was selected.
		$cat = Category::where('slug', $slug)->first();

		// If no category found, redirect back the user.
		if (!$cat) {
			return redirect()->back();
		}

		// Grab all the categories for drop-down menu.
		$categories = Category::orderBy('name', 'asc')->get();

		// Filter files by category selected.
		$files = File::leftJoin('category_file', 'category_file.file_id', '=', 'files.id')->where('category_id', $cat->id)->paginate(self::PERPAGE);

		return view('files.index', compact('files', 'categories'));
	}


	/**
	 * @param Request $request
	 * @param File $file
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
	 */
	public function show(Request $request, File $file) {

		// If the file is not visible, abort
		// -- "visible" coming from 'File' model
		if (!$file->visible()) {
			return abort(404);
		}

		$uploads = $file->uploads()->approved()->withoutPreviewFiles()->latest()->get();

		$uploadPreviews = $file->uploads()->approved()->withPreviewFiles()->latest()->get();

		if (auth()->user()) {
			// Check and see if the file_id on the sales table = to the current file id beign shown and the 'bought_user_id' = the the current user id signed in
			// Checking to see if the currently signed in user owns the file being passed in.
			$currentUserOwnsThisFile = Sale::where( 'file_id', '=', $file->id )->where( 'bought_user_id', '=', auth()->user()->id )->count();
		}

		// Get all the categories associated with this file
		$cat = DB::table('category_file')->where('file_id', $file->id)->get();

		// Pluck the category IDs
		$pluck = $cat->pluck('category_id');

		// Select all the categories where in thge "pluck" array above
		$categories = Category::whereIn('id',$pluck )->take(15)->get();

		// Get the users courses for this particular file, excluding the one that is being shown.
		$otherUsersCourses = File::where('user_id', '=', $file->user_id)->where('id', '!=', $file->id)->approved()->take(3)->latest()->get();

		$page = $request->get('page', 1);

		$comments = Comment::where('commentable_id', $file->id)
		                   ->where('commentable_type', 'App\File')
		                   ->where('parent_id', null)
		                   ->latest()
		                   ->forPage($page, self::PERPAGE)
		                   ->get();

		if ($file->comments->count() > 0) {
			$comments = new LengthAwarePaginator(
				$comments,
				count( $file->comments->where('parent_id', null)),
				self::PERPAGE,
				$page,
				[ 'path' => $request->url(), 'query' => $request->query() ]
			);
		}

		return view('files.show',compact('file', 'uploads', 'uploadPreviews', 'currentUserOwnsThisFile', 'otherUsersCourses', 'comments', 'categories'));
	}


	/**
	 * @param Request $request
	 * @param $id
	 *
	 * @return mixed
	 */
	public function storeComment(Request $request, $id) {


		$this->validate($request, [
			'body' => 'required|min:3|max:2500',
			'g-recaptcha-response' => ['required', new Recaptcha()]
		]);

		$comment = Comment::create([
			'user_id' => auth()->user()->id,
			'body' => $request->body,
			'commentable_id' => $id,
			'commentable_type' => 'App\File'
		]);

		return back()->withSuccess("Comment created.");
	}


	/**
	 * @param Request $request
	 * @param $file
	 * @param $id
	 *
	 * @return mixed
	 */
	public function storeReply(Request $request, $file, $id) {

		$this->validate($request, [
			'replyBody' => 'required|min:3|max:2500'
		]);

		$reply = Comment::create([
			'user_id' => auth()->user()->id,
			'body' => $request->replyBody,
			'parent_id' => $id,
			'commentable_id' => $file,
			'commentable_type' => 'App\File'
		]);

		return back()->withSuccess("Reply created.");
	}


	/**
	 * Delete the comment along with its children replies if any.
	 * @param $id
	 * @param $fileId
	 *
	 * @return mixed
	 */
	public function destroyComment($id, $fileId) {

		$parent = Comment::where('id', $id)->where('commentable_id', $fileId)->where('commentable_type', 'App\File')->first();

		// Getting all children ids
		$array_of_ids = $this->getChildren($parent);

		// Appending the parent comment id
		array_push($array_of_ids, $id);

		Comment::destroy($array_of_ids);

		return back()->withSuccess("Comment deleted.");
	}


	/**
	 * Get the children replies of a comment passed in.
	 * @param $comment
	 *
	 * @return array
	 */
	private function getChildren($comment){
		$ids = [];

		foreach ($comment->replies as $reply) {
			$ids[] = $reply->id;
			$ids = array_merge($ids, $this->getChildren($reply));
		}

		return $ids;
	}
}
