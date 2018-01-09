<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class AccountStatsComposer {


	/**
	 * @param View $view
	 */
	public function compose(View $view) {

		// Grab currently authenticated user.
		$user = auth()->user();

		// Grab user sales.
		$sales = $user->sales;

		// Grab user files that are 'finished'.
		// -- "finished" scope on 'File' model
		$files = $user->files()->finished();

		// Grab the sales earned overall for this authenticated user.
		// -- "saleValueOverLifetime" coming from 'User' model.
		$lifetimeEarned = $user->saleValueOverLifetime();

		$view->with([
			'fileCount' => $files->count(),
			'saleCount' => $sales->count(),
			'thisMonthEarned' => $user->saleValueThisMonth(),
			'lifetimeEarned' => $lifetimeEarned
		]);
	}
}