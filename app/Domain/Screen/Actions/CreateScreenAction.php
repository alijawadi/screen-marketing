<?php

declare(strict_types=1);

namespace Domain\Screen\Actions;

use Domain\Screen\Models\Screen;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateScreenAction
{
    use AsAction;

    public function handle(array $data = []): Screen
    {
        return Screen::create($data);
    }
}
