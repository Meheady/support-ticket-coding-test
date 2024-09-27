<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $user = auth()->user();

            if ($user) {
                $unreadTicketOpenNotifications = $user->unreadNotifications()
                    ->where('type', 'App\Notifications\SupportTicketOpenedNotification')
                    ->count();

                $unreadTicketReplyNotifications = $user->unreadNotifications()
                    ->where('type', 'App\Notifications\SupportTicketReplyNotification')
                    ->count();
            } else {
                $unreadTicketOpenNotifications = 0;
                $unreadTicketReplyNotifications = 0;
            }
            $view->with([
                'unreadTicketOpenNotifications' => $unreadTicketOpenNotifications,
                'unreadTicketReplyNotifications' => $unreadTicketReplyNotifications
            ]);
        });
    }
}
