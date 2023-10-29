<?php

namespace Domain\Screen\Actions;

use App\Domain\Screen\Actions\AuthenticateScreen;
use Domain\Screen\Models\PairingCode;
use Domain\Screen\Models\Screen;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lorisleiva\Actions\Concerns\AsAction;

class CheckPairingStatusAction
{
    use AsAction;

    public function handle(string $code): array|null
    {
        /** @var PairingCode $pairingCode */
        $pairingCode = PairingCode::query()->where('code', "=", $code)->first();

        if (!$pairingCode->organization_id) {
            return null;
        }

        /** @var Screen $screen */
        $screen = Screen::query()->find($pairingCode->screen_id);

        $token = $screen->createToken('paired')->plainTextToken;

        //***********************************************************
        $subscriptions = [
            $screen->broadcast_chanel,
        ];

        $jwtConfiguration = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText(config('broadcasting.connections.mercure.secret'))
        );

        $mercureToken = $jwtConfiguration->builder()
            ->withClaim('mercure', ['subscribe' => $subscriptions])
            ->getToken($jwtConfiguration->signer(), $jwtConfiguration->signingKey())
            ->toString();

        $broadcastChanel = $screen->broadcast_chanel;

        return [
            "token" => $token,
            "mercureToken" => $mercureToken,
            "broadcastChanel" => $broadcastChanel,
        ];
    }
}
