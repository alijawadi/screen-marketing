<?php

use App\Application\Panel\Controllers\Media\MediaController;
use App\Application\Panel\Controllers\Screen\ScreenContentController;
use App\Application\Panel\Controllers\Screen\ScreenController;
use App\Application\Panel\Controllers\User\AuthControllerApp;
use Illuminate\Support\Facades\Route;
use App\Application\Panel\Controllers\Organization\OrganizationController;
use App\Application\Panel\Controllers\Folder\FolderController;
use App\Application\Panel\Controllers\Canvas\CanvasController;

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

Route::middleware(['auth:api'])->group(function () {

    Route::prefix('organization')->group(function () {
        Route::get('/get', [OrganizationController::class, 'get']);
        Route::post('/save', [OrganizationController::class, 'save']);
    });

    Route::prefix('screens')->group(function () {
        Route::get('/list', [ScreenController::class, 'index']);
        Route::post('/add', [ScreenController::class, 'add']);
        Route::post('/change-setting', [ScreenController::class, 'add']);
    });

    Route::prefix('canvas')->group(function () {
        Route::get('/get', [CanvasController::class, 'get']);
        Route::post('/add_file', [CanvasController::class, 'addFile']);
        Route::post('/remove_file', [CanvasController::class, 'removeFile']);
        Route::post('/save_store', [CanvasController::class, 'saveStore']);
    });

    //playlist
    //playlist-log from screen

    Route::prefix('folders')->group(function () {
        Route::get('/list', [FolderController::class, 'list']);
        Route::post('/create', [FolderController::class, 'create']);
        Route::put('/update', [FolderController::class, 'update']);
        Route::put('/delete', [FolderController::class, 'delete']);
    });

    Route::prefix('media')->group(function () {
        Route::get('/list', [MediaController::class, 'list']);
        Route::post('/upload', [MediaController::class, 'upload']);
        Route::put('/remove', [MediaController::class, 'remove']);
        Route::post('/set_to_screen', [ScreenContentController::class, 'setScreenContentByMediaId']);
    });

});
