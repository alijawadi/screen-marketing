<?php

use App\Application\Panel\Controllers\Media\MediaController;
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

Route::post('/user/register', [AuthControllerApp::class, 'register']);
Route::post('/user/login', [AuthControllerApp::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){

    Route::post('/screen/add', [ScreenController::class, 'add']);
    Route::get('/media', [MediaController::class, 'index']);
    Route::post('/media/store', [MediaController::class, 'store']);

});
