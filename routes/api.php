<?php

use App\Http\Controllers\Api\CinemaController;
use App\Http\Controllers\Api\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('cinema', CinemaController::class)->except(['index']);
    Route::apiResource('movie', MovieController::class);
});

Route::get('cinema', [CinemaController::class, 'index']);
