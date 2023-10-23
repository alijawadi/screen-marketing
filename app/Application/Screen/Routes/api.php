<?php

use App\Application\Screen\Controllers\PairingController;
use App\Application\Screen\Controllers\ScreenDataController;
use Domain\Screen\Actions\CheckPairingStatusAction;
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

Route::post('/code/generate', [PairingController::class, 'generateCode']);
Route::post('/code/check', [PairingController::class, 'checkCode']);


//todo production: move this route to auth group
Route::post('/screen/update', [ScreenDataController::class, 'update']);

Route::middleware('auth:sanctum')->group(function () {

});
