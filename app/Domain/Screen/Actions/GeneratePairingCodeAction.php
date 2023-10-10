<?php

namespace Domain\Screen\Actions;

use App\Domain\Screen\DataTransferObjects\ScreenDTO;
use Domain\Screen\Models\PairingCode;
use Lorisleiva\Actions\Concerns\AsAction;

class GeneratePairingCodeAction
{
    use AsAction;

    const UNAMBIGUOUS_ALPHABET = 'BCDFGHJMNPRSTWXY2456789';

    public function handle(ScreenDTO $screenDTO = null, int $characters = 6): PairingCode
    {
        do {
            $code = $this->generateCode($characters);
        } while (PairingCode::where('code', $code)->exists());

        $pairingCode = new PairingCode();
        $pairingCode->code = $code;
        $pairingCode->screen_id = $screenDTO->id;
        $pairingCode->save();

        return $pairingCode;
    }

    protected function generateCode(int $characters): string
    {
        return substr(str_shuffle(str_repeat(static::UNAMBIGUOUS_ALPHABET, $characters)), 0, $characters);
    }
}
