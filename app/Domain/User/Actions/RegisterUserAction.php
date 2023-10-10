<?php

namespace Domain\User\Actions;

use App\Domain\User\DataTransferObjects\AuthUserDTO;
use App\Domain\User\DataTransferObjects\UserDTO;
use Domain\User\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class RegisterUserAction
{
    use AsAction;

    /**
     * @unauthenticated
     */
    public function handle(UserDTO $data): AuthUserDTO
    {
        $user = new User();
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = $data->password;
        $user->save();

        return AuthUserDTO::from($user->createToken('register')->plainTextToken);
    }

}
