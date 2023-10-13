<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TicketCategoryController;

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

Route::prefix('auth')->group(function () {
    Route::post('token', [LoginController::class, 'token']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('whoami', [LoginController::class, 'whoami']);
        Route::post('logout', [LoginController::class, 'logout']);
    });
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('categories', [TicketCategoryController::class, 'index']);
    Route::apiResource('tickets', TicketController::class);
    Route::patch('tickets/{ticket}/status', [TicketController::class, 'status']);
    Route::get('tickets/{ticket}/history', [TicketController::class, 'history']);
    Route::apiResource('tickets.messages', MessageController::class)->shallow();
    Route::apiResource('users', UserController::class)->only('show');
});
