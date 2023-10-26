<?php

use App\Application\Panel\Controllers\Media\MediaController;
use App\Application\Panel\Controllers\Screen\ScreenController;
use App\Application\Panel\Controllers\User\AuthControllerApp;
use Illuminate\Support\Facades\Route;
use App\Application\Panel\Controllers\Organization\OrganizationController;
use App\Application\Panel\Controllers\Template\TemplateController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/qq', function () {
    return view("test_mercure");
});

Route::middleware(["throttle:api_20"])->group(function () {
    Route::post('/user/register', [AuthControllerApp::class, 'register']);
    Route::post('/user/login', [AuthControllerApp::class, 'login']);
});

Route::middleware(['auth:api', "throttle:api_1000"])->group(function () {

    Route::prefix('organization')->group(function () {
        Route::get('/get', [OrganizationController::class, 'get']);
        Route::post('/save', [OrganizationController::class, 'save']);
    });

    Route::prefix('screens')->group(function () {
        Route::get('/list', [ScreenController::class, 'index']);
        Route::post('/add', [ScreenController::class, 'add']);
    });

    Route::prefix('template')->group(function () {
        Route::get('/get', [TemplateController::class, 'get']);
        Route::post('/add_template_file', [TemplateController::class, 'addTemplateFile']);
        Route::post('/remove_template_file', [TemplateController::class, 'removeTemplateFile']);
        Route::post('/save_store', [TemplateController::class, 'saveStore']);
    });

    Route::prefix('folders')->group(function () {

    });

    Route::prefix('media')->group(function () {
        Route::get('/', [MediaController::class, 'index']);
        Route::post('/store', [MediaController::class, 'store']);
    });

});
