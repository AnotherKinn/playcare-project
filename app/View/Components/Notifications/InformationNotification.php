<?php

namespace App\View\Components\Notifications;

use Illuminate\View\Component;

class InformationNotification extends Component
{
    public $notification;

    public function __construct($notification)
    {
        $this->notification = $notification;
    }

    public function render()
    {
        return view('components.notifications.information-notification');
    }
}
