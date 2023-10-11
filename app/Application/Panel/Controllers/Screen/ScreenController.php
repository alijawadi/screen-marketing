<?php

declare(strict_types=1);

namespace App\Application\Panel\Controllers\Screen;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\ScreenAddRequest;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Screen\Actions\PanelScreenList;
use App\Domain\Screen\DataTransferObjects\AddScreenDTO;
use Domain\Screen\Actions\AssignScreenAction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ScreenController extends PanelAppBaseController
{
    /**
     * Panel: List of Screens
     *
     * @param Request $request
     * @return SuccessResponse
     */
    public function index(Request $request): SuccessResponse
    {
        $list = PanelScreenList::run();
        return new SuccessResponse($list);
    }

    /**
     * Panel: Add Screen
     *
     * @param ScreenAddRequest $request
     * @return Response
     */
    public function add(ScreenAddRequest $request): Response
    {
        $screenDTO = AddScreenDTO::from(array_merge(
            $request->toArray(),
            ['organization_id' => $request->user()->organization_id]
        ));

        AssignScreenAction::run($screenDTO);
        return new SuccessResponse();
    }
}
