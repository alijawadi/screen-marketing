<?php

namespace Domain\User\Actions;

use App\Domain\User\DataTransferObjects\AuthUserDTO;
use App\Domain\User\DataTransferObjects\UserDTO;
use Domain\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\Concerns\AsAction;

class LoginUserAction
{
    use AsAction;

    public function handle(array $userDTO): string|null
    {
        $user = User::query()
            ->where('email', "=", $userDTO["email"])->first();

        if (!$user || !Hash::check($userDTO["password"], $user->password)) {
            return null;
        }

        return $user->createToken('login')->plainTextToken;
    }
}
