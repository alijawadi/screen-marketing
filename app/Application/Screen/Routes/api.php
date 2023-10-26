<?php

use App\Application\Screen\Controllers\PairingController;
use App\Application\Screen\Controllers\ScreenDataController;
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
    Route::post('/code/generate', [PairingController::class, 'generateCode']);
    Route::post('/code/check', [PairingController::class, 'checkCode']);
});

Route::middleware(['auth:screen', "throttle:api_1000"])->group(function () {
    Route::post('/save_data', [ScreenDataController::class, 'saveData']);
    // Route::post('/save_setting', [ScreenDataController::class, 'saveSetting']);
    // Route::get('/get_data', [ScreenDataController::class, 'getData']);
    // Route::get('/get_setting', [ScreenDataController::class, 'getSetting']);
});

