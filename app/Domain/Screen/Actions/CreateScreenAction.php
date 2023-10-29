<?php

declare(strict_types=1);

namespace Domain\Screen\Actions;

use Domain\Screen\Models\Screen;
use Illuminate\Database\Eloquent\Model;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateScreenAction
{
    use AsAction;

    public function handle(array $data): Screen|Model
    {
        return Screen::query()->create($data);
    }
}
