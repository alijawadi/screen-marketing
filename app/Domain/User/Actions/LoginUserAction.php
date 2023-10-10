<?php

namespace Domain\User\Actions;

use App\Domain\User\DataTransferObjects\AuthUserDTO;
use App\Domain\User\DataTransferObjects\UserDTO;
use Domain\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;

class LoginUserAction
{
    use AsAction;

    /**
     * @throws ValidationException
     */
    public function handle(UserDTO $userDTO): ?AuthUserDTO
    {
        $user = User::where('email', $userDTO->email)/*->whereNotNull('verified_at')*/->first();

        if (!$user || !Hash::check($userDTO->password, $user->password)) {
            return null;
        }

        return AuthUserDTO::from($user->createToken('login')->plainTextToken);
    }
}
