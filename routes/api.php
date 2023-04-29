<?php

use App\Http\Controllers\ClockInController;
use App\Http\Controllers\WorkerController;
use Illuminate\Http\Request;
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


Route::prefix('worker')->group(function () {
    Route::post('clock-in', [ClockInController::class, 'clockIn']);
    Route::get('clock-ins', [ClockInController::class, 'getClockIns']);
});

Route::prefix('clockin')->group(function () {
    Route::get('', [ClockInController::class, 'index']);
    Route::get('{id}', [ClockInController::class, 'show']);
    Route::post('', [ClockInController::class, 'store']);
    Route::put('{id}', [ClockInController::class, 'update']);
    Route::delete('{id}', [ClockInController::class, 'delete']);
});

Route::prefix('worker')->group(function () {
    Route::get('', [WorkerController::class, 'index']);
    Route::get('{id}', [WorkerController::class, 'show']);
    Route::post('', [WorkerController::class, 'store']);
    Route::put('{id}', [WorkerController::class, 'update']);
    Route::delete('{id}', [WorkerController::class, 'delete']);
});

