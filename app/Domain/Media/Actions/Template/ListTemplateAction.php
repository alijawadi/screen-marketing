<?php

namespace App\Domain\Media\Actions\Template;

use App\Domain\Media\DataTransferObjects\TemplateDTO;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsObject;
use Spatie\LaravelData\CursorPaginatedDataCollection;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\PaginatedDataCollection;

class ListTemplateAction
{
    use AsObject;

    public function handle(): DataCollection|CursorPaginatedDataCollection|PaginatedDataCollection
    {
        //todo get the OrgId from the app layer
        $templates = Auth::user()->organization->templates();

        return TemplateDTO::collection($templates->paginate());
    }
}
