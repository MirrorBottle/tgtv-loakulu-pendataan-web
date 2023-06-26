<?php

namespace App\Http\Livewire;

use App\Models\Notification;
use Livewire\Component;

class Notifications extends Component
{
    public function render()
    {
        return view('livewire.notifications', [
            'notifications' => auth()->user()->getNotReadNotifs()
        ]);
    }

    public function read($notification_id) {
        Notification::find($notification_id)->update(['is_read' => 1]);
    }
}
