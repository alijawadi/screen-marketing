<?php

namespace App\Application\Screen\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ScreenAppBaseController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
