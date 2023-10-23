<?php

namespace Domain\Screen\Actions;

use Domain\Screen\Models\PairingCode;
use Illuminate\Database\Eloquent\Model;
use Lorisleiva\Actions\Concerns\AsAction;

class GeneratePairingCodeAction
{
    use AsAction;

    const UNAMBIGUOUS_ALPHABET = 'BCDFGHJMNPRSTWXY2456789';

    public function handle(int $screen_id): PairingCode|Model
    {
        do {
            $code = $this->generateCode(6);
        } while (PairingCode::query()->where('code', "=", $code)->exists());

        $pairingCode = PairingCode::query()
            ->create([
                "code" => $code,
                "screen_id" => $screen_id,
                "organization_id" => null,
            ]);

        return $pairingCode;
    }

    protected function generateCode(int $characters): string
    {
        return substr(str_shuffle(str_repeat(static::UNAMBIGUOUS_ALPHABET, $characters)), 0, $characters);
    }
}
