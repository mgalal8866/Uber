<?php

namespace App\Events;

use App\Models\Trip;
use App\Models\User;
use App\Http\Resources\TripResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TripStarted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $trip;


    /**
     * Create a new event instance.
     */
    public function __construct(Trip $trip )
    {
        $this->trip = $trip;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('trip-' . $this->trip->id)
        ];
    }
    public function broadcastWith()
    {
        return (new TripResource($this->trip))->toArray(request());
    }
    public function broadcastAs()
    {
        return  'TripStared';
    }
}
