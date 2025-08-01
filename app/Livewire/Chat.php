<?php

namespace App\Livewire;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    public $message = '';

    protected $listeners = ['echo:chat,MessageSent' => 'refreshMessages'];

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string|max:1000',
        ]);

        $msg = Message::create([
            'user_id' => Auth::id(),
            'body' => $this->message,
        ]);

        broadcast(new \App\Events\MessageSent($msg))->toOthers();

        $this->message = '';
    }

    public function refreshMessages()
    {
        // re-render
    }

    public function render()
    {
        return view('livewire.chat', [
            'messages' => Message::with('user')->latest()->take(50)->get()->reverse(),
        ]);
    }
}
