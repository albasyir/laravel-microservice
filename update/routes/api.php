<?php
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdentityController;

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::post('/identities', IdentityController::class);
});
