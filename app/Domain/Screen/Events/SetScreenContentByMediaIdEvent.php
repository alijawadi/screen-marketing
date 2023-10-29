<?php

namespace App\Domain\Screen\Events;

use App\Domain\Media\DataTransferObjects\MediaDTO;
use Duijker\LaravelMercureBroadcaster\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SetScreenContentByMediaIdEvent implements ShouldBroadcast
{
    public function __construct(protected string $chanel, public MediaDTO $media)
    {
    }

    public function broadcastOn(): Channel
    {
        return new Channel($this->chanel, true);
    }
}
