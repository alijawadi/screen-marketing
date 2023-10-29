<?php

namespace App\Application\Panel\Controllers\Screen;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\SetScreenContentByMediaIdRequest;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Screen\Actions\SetContentByMediaIdAction;

class ScreenContentController extends PanelAppBaseController
{
    /**
     * Set Screen content by Media_ID
     *
     * @param SetScreenContentByMediaIdRequest $request
     * @return SuccessResponse
     */
    public function setScreenContentByMediaId(SetScreenContentByMediaIdRequest $request): SuccessResponse
    {
        $data = $request->validated();
        $data = SetContentByMediaIdAction::run($data);
        return new SuccessResponse($data);
    }
}
