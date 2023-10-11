<?php

namespace App\Domain\Media\Actions\Template;

use App\Domain\Media\DataTransferObjects\TemplateDTO;
use App\Domain\Media\DataTransferObjects\TemplateStoreDTO;
use App\Domain\Media\Models\Template;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsObject;

class StoreTemplateAction
{
    use AsObject;

    public function handle(TemplateStoreDTO $templateStoreDTO): TemplateDTO
    {
        // todo get the orgId from app layer
        $template = Template::create([
            "data" => $templateStoreDTO->data,
            "organization_id" => Auth::user()->organization_id
        ]);

        $template->addMediaFromBase64($templateStoreDTO->file)->toMediaCollection();

        return TemplateDTO::from($template);
    }
}
