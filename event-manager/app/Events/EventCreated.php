<?php
namespace App\Events;

use App\Models\Event; // Ensure you have the correct Event model
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EventCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $event; // The event data to broadcast

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->event = $event;  // Passing the event model data
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel
     */
    public function broadcastOn()
    {
        return new Channel('events'); // Broadcasting on the 'events' channel
    }

    /**
     * The name of the event for the client to listen for.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'event.created'; // Name the event 'event.created' for clients to listen for
    }

    /**
     * Get the data to broadcast with the event.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'id' => $this->event->id,
            'title' => $this->event->title,
            'category' => $this->event->category,
            'image' => $this->event->image,
            'location' => $this->event->location,
            'date' => $this->event->date,
            'description' => $this->event->description,
            'rating' => $this->event->rating,
            'price' => $this->event->price,
        ];
    }
}
