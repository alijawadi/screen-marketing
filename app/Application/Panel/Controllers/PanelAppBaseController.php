<?php

namespace App\Application\Panel\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class PanelAppBaseController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
