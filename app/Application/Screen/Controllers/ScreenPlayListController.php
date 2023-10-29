<?php

namespace App\Application\Screen\Controllers;

use App\Application\Screen\Requests\SaveScreenDataRequest;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Screen\Actions\SaveScreenDataAction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ScreenPlayListController extends ScreenAppBaseController
{
    /**
     * Update Screen Data
     *
     * @param Request $request
     * @return Response
     */
    public function getPlaylist(Request $request): Response
    {
        $data = [

        ];


        return new SuccessResponse();
    }


}
