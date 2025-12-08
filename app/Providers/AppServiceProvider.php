<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

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
        
    {
        View::composer('*', function ($view) {

        if (Auth::check()) {
            $unreadNotifCount = Notification::where('user_id', Auth::id())
                ->where('is_read', false)
                ->count();

            $notifications = Notification::where('user_id', Auth::id())
                ->latest()
                ->limit(10)
                ->get();
        } else {
            $unreadNotifCount = 0;
            $notifications = collect();
        }

        $view->with([
            'unreadNotifCount' => $unreadNotifCount,
            'notifications' => $notifications
        ]);
    });

    }
    
}
}