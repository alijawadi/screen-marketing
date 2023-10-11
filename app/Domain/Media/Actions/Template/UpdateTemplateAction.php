<?php

namespace App\Domain\Media\Actions\Template;

use App\Domain\Media\DataTransferObjects\TemplateDTO;
use App\Domain\Media\DataTransferObjects\TemplateStoreDTO;
use App\Domain\Media\Models\Template;
use Lorisleiva\Actions\Concerns\AsObject;

class UpdateTemplateAction
{
    use AsObject;

    public function handle(TemplateStoreDTO $templateStoreDTO): TemplateDTO
    {
        $template = Template::find($templateStoreDTO->id);
        $template->update($templateStoreDTO->except("id")->toArray());

        // todo: add the new one, then delete the old one.
        $template->clearMediaCollection();
        $template->addMediaFromBase64($templateStoreDTO->file)->toMediaCollection();

        return TemplateDTO::from($template);
    }
}
