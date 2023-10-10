<?php

namespace App\Domain\Screen\Actions;

use Domain\Screen\Models\Screen;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\Sanctum;
use Lorisleiva\Actions\Concerns\AsObject;

class AuthenticateScreen
{

    use AsObject;

    public function handle(Screen $screen): NewAccessToken
    {
        Sanctum::actingAs($screen, [], 'screen');
        return $screen->createToken('paired');
    }
}
