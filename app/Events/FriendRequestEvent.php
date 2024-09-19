<?php

// app/Events/FriendRequestEvent.php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FriendRequestEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;

    public function __construct($id)
    {
        $this->id = $id;
        Log::info('Evento disparado: ' . $id);
    }

    public function broadcastOn()
    {
        Log::info('Broadcasting on channel: my-channel');
        return ['Invite.User.' . $this->id];
    }

    public function broadcastAs()
    {
        Log::info('Broadcasting as event: my-event');
        return 'Invite.' . $this->id;
    }
}
