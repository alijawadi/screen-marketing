<?php

namespace App\Application\Screen\Controllers;

use App\Application\Screen\Requests\CodeCheckRequest;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Screen\DataTransferObjects\ScreenDTO;
use Domain\Screen\Actions\CheckPairingStatusAction;
use Domain\Screen\Actions\CreateScreenAction;
use Domain\Screen\Actions\GeneratePairingCodeAction;
use Illuminate\Http\Response;

class PairingController extends ScreenAppBaseController
{
    /**
     * Generate Pairing Code
     *
     * @return Response
     */
    public function generateCode(): Response
    {
        $screen = CreateScreenAction::run();
        $pairingCode = GeneratePairingCodeAction::run(ScreenDTO::from($screen));
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
        $token = CheckPairingStatusAction::run($request->code);

        return new SuccessResponse(['success' => true, 'token' => $token]);
    }
}
