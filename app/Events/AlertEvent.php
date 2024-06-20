<?php


namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;

class AlertEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    public $alerts;

    public function __construct($data)
    {
        $this->alerts = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        return ['alert-event'];
    }

    public function broadcastAs()
    {
        return 'alert-event';
    }
}