<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationComposer
{
    public function compose(View $view)
    {
        $notifCount = 0;

        if (Auth::check()) {
            $notifCount = Notification::where('user_id', Auth::id())->count();
        }

        $view->with('notifCount', $notifCount);
    }
}
