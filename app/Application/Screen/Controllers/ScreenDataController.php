<?php

namespace App\Application\Screen\Controllers;

use App\Application\Screen\Requests\SaveScreenDataRequest;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Screen\Actions\SaveScreenDataAction;
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
}
