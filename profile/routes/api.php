<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValidateController;
use App\Http\Middleware\JwtMiddleware;

Route::middleware([JwtMiddleware::class])->group(function() {
    Route::get('/validate', ValidateController::class);
});