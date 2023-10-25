<?php

namespace App\Domain\Media\Actions\Template;

use App\Domain\Media\Models\Template;
use App\Services\AwsService;
use Illuminate\Http\UploadedFile;
use Lorisleiva\Actions\Concerns\AsObject;

class RemoveTemplateFileAction
{
    use AsObject;

    public function handle(int $organization_id, array $data)
    {
        /** @var Template $template */
        $template = Template::query()
            ->where("organization_id", "=", $organization_id)
            ->first();

        $templates = json_decode(json_encode($template->templates), true);

        if (isset($templates[$data["template_id"]])) {
            $awsService = new AwsService();
            $awsService->removeFile($templates[$data["template_id"]]["key"]);

            unset($templates[$data["template_id"]]);

            $template->update([
                "templates" => $templates,
            ]);
        }
    }

}
