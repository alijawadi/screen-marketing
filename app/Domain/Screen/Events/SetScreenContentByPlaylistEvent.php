<?php

namespace App\Domain\Screen\Events;

use Duijker\LaravelMercureBroadcaster\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SetScreenContentByPlaylistEvent implements ShouldBroadcast
{
    public function __construct(protected string $chanel, public array $media)
    {
    }

    public function broadcastOn(): Channel
    {
        return new Channel($this->chanel, true);
    }
}
