<?php

namespace App\Application\Panel\Controllers\User;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\LoginUserRequest;
use App\Application\Panel\Requests\RegisterUserRequest;
use App\Application\Shared\Responses\ErrorResponse;
use App\Application\Shared\Responses\SuccessResponse;
use Domain\User\Actions\LoginUserAction;
use Domain\User\Actions\RegisterUserAction;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AuthControllerApp extends PanelAppBaseController
{
    /**
     * Register User
     *
     * @param RegisterUserRequest $request
     * @return Response
     */
    public function register(RegisterUserRequest $request): Response
    {
        $token = RegisterUserAction::run($request->validated());

        return new SuccessResponse(["token" => $token], 201);
    }

    /**
     * Login User
     *
     * @param LoginUserRequest $request
     * @return Response
     * @throws ValidationException
     */
    public function login(LoginUserRequest $request): Response
    {
        $token = LoginUserAction::run($request->validated());

        if (!$token) {
            return new ErrorResponse("The provided credential is incorrect.", 401);
        }

        return new SuccessResponse(["token" => $token]);
    }
}
