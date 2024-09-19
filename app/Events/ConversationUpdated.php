<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ConversationUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    // public function broadcastOn()
    // {
    //     return new PrivateChannel('Conversation.User.' . $this->userId);
    // }

    public function broadcastOn()
    {
        Log::info('Broadcasting on channel: friendship-channel');
        return ['Conversation.User.' . $this->userId];
    }
    public function broadcastAs()
    {
        Log::info('Broadcasting as event: friendhip-event');
        return 'ConversationUpdated';
    }
}
