<?php

namespace App\Events;


use App\Models\Trip;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TripAccepted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $trip;
    private $user;


    public function __construct(Trip $trip, User $user)
    {
        $this->trip = $trip;
        $this->user = $user;
    }


    public function broadcastOn(): array
    {
        return [
            new Channel('passenger_' . $this->user->id)
        ];
    }
}
