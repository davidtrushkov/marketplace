<?php

namespace App\Providers;

use App\Http\ViewComposers\AccountStatsComposer;
use App\Http\ViewComposers\AdminStatsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('account.layouts._stats', AccountStatsComposer::class);
	    View::composer('admin.partials._stats', AdminStatsComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
