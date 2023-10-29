<?php

use App\Application\Screen\Controllers\PairingController;
use App\Application\Screen\Controllers\ScreenDataController;
use Illuminate\Support\Facades\Route;
use App\Application\Screen\Controllers\ScreenPlayListController;

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
    Route::post('/code/generate', [PairingController::class, 'generateCode']);
    Route::post('/code/check', [PairingController::class, 'checkCode']);
});

Route::middleware(['auth:screen'])->group(function () {
    Route::post('/save_data', [ScreenDataController::class, 'saveData']);
    Route::post('/save_setting', [ScreenDataController::class, 'saveSetting']);
    Route::get('/get_data', [ScreenDataController::class, 'getData']);
    Route::get('/get_setting', [ScreenDataController::class, 'getSetting']);

    Route::get('/get_playlist', [ScreenPlayListController::class, 'getPlaylist']);
});

