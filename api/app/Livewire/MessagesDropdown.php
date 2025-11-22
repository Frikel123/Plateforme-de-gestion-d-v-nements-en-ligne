<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Component;

class MessagesDropdown extends Component
{

    public $messages;
    public $unreadExists;

    public function mount()
    {
        $this->messages = Message::orderBy('created_at', 'desc')->get();
        $this->unreadExists = $this->messages->where('read_at', null)->isNotEmpty();
    }

    public function markAsRead($id)
    {
        $message = Message::find($id);
        if ($message) {
            $message->read_at = now();
            $message->save();
            $this->mount();
        }
    }
    public function markAsReadAll()
    {
        $unreadMessages = Message::whereNull('read_at')->get();

        foreach ($unreadMessages as $message) {
            $message->read_at = now();
            $message->save();
        }

        $this->mount();
    }
    public function render()
    {
        return view('livewire.messages-dropdown');
    }
}
