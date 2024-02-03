<?php

use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\BookDistributionController;
use App\Http\Controllers\API\BookWriteOffController;
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

Route::apiResource('book', BookController::class)->only(['store', 'index']);
Route::apiResource('book/distribution', BookDistributionController::class)->only(['store']);
Route::apiResource('book/write-off', BookWriteOffController::class)->only(['store']);


