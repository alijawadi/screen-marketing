<?php

namespace App\Domain\Screen\Actions;

use Domain\Screen\Models\PairingCode;
use Lorisleiva\Actions\Concerns\AsObject;

class RetrievePairingCode
{
    use AsObject;

    public function handle(string $code)
    {
        return PairingCode::where('code', $code)->firstOrFail();
    }
}
