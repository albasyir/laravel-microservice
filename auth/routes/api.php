<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ValidateTokenController;

Route::post('/', LoginController::class);
Route::post('validate', ValidateTokenController::class);
