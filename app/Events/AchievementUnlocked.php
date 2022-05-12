<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class AchievementUnlocked
{
    use Dispatchable, SerializesModels;
    public $achievement_name;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($achievement_name, User $user)
    {
        $this->user = $user;
        $this->achievement_name = $achievement_name;
        
    }

}