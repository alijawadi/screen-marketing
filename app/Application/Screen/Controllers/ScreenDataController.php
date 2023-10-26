<?php

namespace App\Application\Screen\Controllers;

use App\Application\Screen\Requests\SaveScreenDataRequest;
use App\Application\Screen\Requests\SaveScreenSettingRequest;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Screen\Actions\SaveScreenDataAction;
use App\Domain\Screen\Actions\SaveScreenSettingAction;
use Illuminate\Http\Response;

class ScreenDataController extends ScreenAppBaseController
{
    /**
     * Update Screen Data
     *
     * @param SaveScreenDataRequest $request
     * @return Response
     */
    public function saveData(SaveScreenDataRequest $request): Response
    {
        SaveScreenDataAction::run($request->validated(), $request->user());

        return new SuccessResponse();
    }

    /**
     * Update Screen Data
     *
     * @param SaveScreenSettingRequest $request
     * @return Response
     */
    public function saveSetting(SaveScreenSettingRequest $request): Response
    {
        SaveScreenSettingAction::run($request->validated(), $request->user());

        return new SuccessResponse();
    }

}
