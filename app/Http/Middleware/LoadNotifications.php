<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Notification;

class LoadNotifications
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $notifications = Notification::where('user_id', auth()->id())
                ->where('status', 'Unread')
                ->get();

            view()->share('notifications', $notifications);
        }

        return $next($request);
    }
}
