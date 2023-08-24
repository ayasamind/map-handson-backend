<?php

use App\Http\Controllers\HealthController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PinController;
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

Route::get('/health', HealthController::class);

Route::get('/maps', [MapController::class, 'index']);
Route::get('/maps/{mapId}', [MapController::class, 'show']);
Route::post('/pins/create', [PinController::class, 'create']);
