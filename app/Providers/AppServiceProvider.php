<?php

namespace App\Providers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        View::composer('*', function($view)
        {
            $today = Carbon::today();
            $count = count(Order::whereDate('created_at', $today)->get());
            $view->with(['count' => $count]);
        });

    }
}
