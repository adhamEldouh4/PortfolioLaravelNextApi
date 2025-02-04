<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/contact', [MessageController::class, 'store']);
Route::get('/messages', [MessageController::class, 'show']);
Route::delete('/messages/{id}', [MessageController::class, 'delete']);
Route::post('/login', [Controller::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [Controller::class, 'logout']);
