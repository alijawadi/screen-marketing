<?php

namespace App\Domain\Screen\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\Mercure\Hub;
use Symfony\Component\Mercure\Jwt\StaticTokenProvider;
use Symfony\Component\Mercure\Update;

class MercurePublish
{
    use AsAction;

    public function handle(string $topic, string $message)
    {
        $hub = new Hub(config('mercure.url'), new StaticTokenProvider(config('mercure.jwt.value')));
        // Serialize the update, and dispatch it to the mercure hub, that will broadcast it to the clients
        $hub->publish(new Update($topic, $message));
    }
}
