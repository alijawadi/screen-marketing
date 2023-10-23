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
        $screen = CreateScreenAction::run($request->all());

        /** @var PairingCode $pairingCode */
        $pairingCode = GeneratePairingCodeAction::run($screen->id);

        return new SuccessResponse(['code' => $pairingCode->code], 201);
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
        $token = CheckPairingStatusAction::run($request->get("code"));

        if (!$token){
            return new ErrorResponse("code is not assigned to any account.",406);
        }

        return new SuccessResponse(['token' => $token]);
    }
}
