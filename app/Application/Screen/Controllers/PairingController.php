<?php

namespace App\Application\Screen\Controllers;

use App\Application\Screen\Requests\CodeCheckRequest;
use App\Application\Screen\Requests\CreateScreenRequest;
use App\Application\Shared\Responses\ErrorResponse;
use App\Application\Shared\Responses\SuccessResponse;
use Domain\Screen\Actions\CheckPairingStatusAction;
use Domain\Screen\Actions\CreateScreenAction;
use Domain\Screen\Actions\GeneratePairingCodeAction;
use Domain\Screen\Models\PairingCode;
use Domain\Screen\Models\Screen;
use Illuminate\Http\Response;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;

class PairingController extends ScreenAppBaseController
{
    /**
     * Generate Pairing Code
     *
     * @return Response
     */
    public function generateCode(CreateScreenRequest $request): Response
    {
        /** @var Screen $screen */
        $screen = CreateScreenAction::run($request->validated());

        /** @var PairingCode $pairingCode */
        $pairingCode = GeneratePairingCodeAction::run($screen->id);

        $screen->update([
            "broadcast_chanel" => $screen->device_id . $pairingCode->code,
        ]);

        //***********************************************************
        $subscriptions = [
            $screen->broadcast_chanel,
        ];

        $jwtConfiguration = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText(config('broadcasting.connections.mercure.secret'))
        );

        $token = $jwtConfiguration->builder()
            ->withClaim('mercure', ['subscribe' => $subscriptions])
            ->getToken($jwtConfiguration->signer(), $jwtConfiguration->signingKey())
            ->toString();

        return new SuccessResponse(["code" => $pairingCode->code, "token" => $token, "broadcast_chanel" => $screen->broadcast_chanel], 201);
    }

    /**
     * Check Pairing Status
     *
     * After pairing the code in the panel the screen receives a message (token) on mercure, but the
     * screen app can also call this endpoint to receive a token.
     *
     * @param CodeCheckRequest $request
     * @return Response
     */
    public function checkCode(CodeCheckRequest $request): Response
    {
        $data = CheckPairingStatusAction::run($request->get("code"));

        if (!$data) {
            return new ErrorResponse("Code is not assigned to any account.", 406);
        }

        return new SuccessResponse($data);
    }
}
