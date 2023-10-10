<?php

namespace App\Application\Screen\Controllers;

use App\Application\Screen\Requests\ScreenDataRequest;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Screen\Actions\StoreScreenDataAction;
use App\Domain\Screen\DataTransferObjects\ScreenDTO;
use Illuminate\Http\Response;

class ScreenDataController extends ScreenAppBaseController
{
    /**
     * Update Screen Data
     *
     * @param ScreenDataRequest $request
     * @return Response
     */
    public function update(ScreenDataRequest $request): Response
    {
        $screen = $request->user();
        $screenDto = ScreenDTO::from($request, $screen->id);
        $screenData = StoreScreenDataAction::run($screenDto);

        return new SuccessResponse($screenData->toArray());
    }
}
