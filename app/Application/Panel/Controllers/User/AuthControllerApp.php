<?php

namespace App\Application\Panel\Controllers\User;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\LoginUserRequest;
use App\Application\Panel\Requests\RegisterUserRequest;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\User\DataTransferObjects\UserDTO;
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
        $authDTO = RegisterUserAction::run($request->validated());

        return new SuccessResponse($authDTO, 201);
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
        $authDTO = LoginUserAction::run(UserDTO::from($request));

        if (!$authDTO) {
            throw ValidationException::withMessages([
                'password' => ['The provided credential is incorrect.'],
            ]);
        }

        return new SuccessResponse($authDTO);
    }
}
