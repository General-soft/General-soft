<?php

use App\Http\Controllers\API\TokenController;
use App\Http\Controllers\API\ValidationController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:grant'])->post('/token', [TokenController::class, 'store']);

Route::post('/validate', [ValidationController::class, 'validate']);
