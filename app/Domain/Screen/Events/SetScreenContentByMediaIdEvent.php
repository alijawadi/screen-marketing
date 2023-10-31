<?php

namespace App\Domain\Screen\Events;

use Duijker\LaravelMercureBroadcaster\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SetScreenContentByMediaIdEvent implements ShouldBroadcast
{
    public function __construct(protected string $channel, public array $media)
    {
    }

    public function broadcastOn(): Channel
    {
        return new Channel($this->channel, true);
    }
}
