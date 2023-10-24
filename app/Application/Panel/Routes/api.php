<?php

use App\Application\Panel\Controllers\Media\MediaController;
use App\Application\Panel\Controllers\Media\TemplateController;
use App\Application\Panel\Controllers\Screen\ScreenController;
use App\Application\Panel\Controllers\User\AuthControllerApp;
use Illuminate\Support\Facades\Route;

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

Route::middleware(["throttle:api_20"])->group(function () {
    Route::post('/user/register', [AuthControllerApp::class, 'register']);
    Route::post('/user/login', [AuthControllerApp::class, 'login']);
});

Route::middleware(['auth:api', "throttle:api_1000"])->group(function () {

    Route::prefix('screen')->group(function () {
        Route::get('/list', [ScreenController::class, 'index']);
        Route::post('/add', [ScreenController::class, 'add']);
    });

    Route::prefix('template')->group(function () {
        Route::get('/list', [TemplateController::class, 'index']);
        Route::post('/store', [TemplateController::class, 'store']);
        Route::post('/update', [TemplateController::class, 'update']);
    });

    Route::prefix('media')->group(function () {
        Route::get('/', [MediaController::class, 'index']);
        Route::post('/store', [MediaController::class, 'store']);
    });

});
