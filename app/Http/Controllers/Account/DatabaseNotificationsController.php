<?php

namespace App\Http\Controllers\Account;

use App\File;
use App\Http\Controllers\Controller;
use App\Notifications\FileChanges;
use App\Sale;
use App\User;
use Illuminate\Http\Request;

class DatabaseNotificationsController extends Controller {


	public function index($identifier) {

		$file = File::where('identifier', $identifier)->first();

		return view( 'account.files.notify.index', compact('file'));
	}


	public function notifyOfChanges(Request $request, $identifier) {

		$this->validate($request, [
			'data' => 'required|min:15|max:2500',
			'header' => 'nullable|max:50|min:5'
		]);

		$data = $request->data;
		$header = $request->header;

		$file = File::where('identifier', $identifier)->first();

		$owner = User::where('id', $file->user_id)->first();

		$sales = Sale::where('file_id', $file->id)->get();

		$userIds = $sales->pluck('bought_user_id');

		$users = User::whereIn('id', $userIds)->get();

		\Notification::send($users, new FileChanges($data, $header, $owner, $file));

		return redirect(route('account.files.index'))->withSuccess('Notification sent successfully to users.');
	}


	public function markAllAsRead() {

		auth()->user()->unreadNotifications->markAsRead();

		return back()->withSuccess('Marked all as read');
	}

}