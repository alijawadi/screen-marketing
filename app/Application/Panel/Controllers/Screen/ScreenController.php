<?php

declare(strict_types=1);

namespace App\Application\Panel\Controllers\Screen;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\ScreenAddRequest;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Screen\Actions\PanelScreenList;
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
        $screens = PanelScreenList::run($request->user()->organization_id);

        return new SuccessResponse($screens);
    }

    /**
     * Panel: Add Screen
     *
     * @param ScreenAddRequest $request
     * @return Response
     */
    public function add(ScreenAddRequest $request): Response
    {
        $data = $request->validated();
        $data["organization_id"] = $request->user()->organization_id;
        $data["created_by"] = $request->user()->id;

        AssignScreenAction::run($data);

        return new SuccessResponse();
    }
}
