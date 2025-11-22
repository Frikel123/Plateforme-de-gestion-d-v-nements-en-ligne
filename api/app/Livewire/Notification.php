<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notification;

class Notifications extends Component
{
    public $notifications;

    protected $listeners = ['refreshNotifications' => 'refresh'];

    public function mount()
    {
        $this->notifications = Notification::where('user_id', auth()->id())
                                           ->orderBy('created_at', 'desc')
                                           ->get();
    }

    public function refresh()
    {
        $this->notifications = Notification::where('user_id', auth()->id())
                                           ->orderBy('created_at', 'desc')
                                           ->get();
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}