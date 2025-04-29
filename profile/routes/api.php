<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValidateController;
use App\Http\Controllers\GetProfileController;
use App\Http\Controllers\UpdateProfileController;
use App\Http\Middleware\JwtMiddleware;

Route::middleware([JwtMiddleware::class])->group(function() {
    Route::get('/validate', ValidateController::class);
    Route::get('/profile', GetProfileController::class);
    Route::post('/profile', UpdateProfileController::class);
});
