<?php

namespace App\Domain\Media\Actions\Template;

use App\Domain\Media\Models\Template;
use App\Services\AwsService;
use Illuminate\Http\UploadedFile;
use Lorisleiva\Actions\Concerns\AsObject;

class AddTemplateFileAction
{
    use AsObject;

    public function handle(int $organization_id, array $data)
    {
        /** @var Template $template */
        $template = Template::query()
            ->where("organization_id", "=", $organization_id)
            ->first();

        /** @var UploadedFile $file */
        $file = $data["template_file"];

        $awsService = new AwsService();
        $file = $awsService->uploadFile("root_" . $organization_id . "/templates/images/" . $data["template_id"] . time() . $file->getClientOriginalName(), $file);

        $templates = json_decode(json_encode($template->templates), true);
        $templates[$data["template_id"]] = [
            "id" => $data["template_id"],
            "key" => $file[0],
            "url" => $file[1],
        ];

        $template->update([
            "templates" => $templates,
        ]);
    }

}
