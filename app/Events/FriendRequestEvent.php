<?php

// app/Events/FriendRequestEvent.php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FriendRequestEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct()
    {
        $this->message = 'real time success';
    }

    public function broadcastOn()
    {
        return new Channel('test-channel');
    }

    public function broadcastWith()
    {
        return ['message' => $this->message];
    }

    public function broadcastAs()
    {
        return 'test-event';
    }
}
