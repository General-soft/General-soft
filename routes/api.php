<?php

declare(strict_types=1);

use App\Http\Controllers\API\TokenController;
use App\Http\Controllers\API\ValidationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:grant'])->post('/tokens', [TokenController::class, 'store']);

Route::middleware(['auth:api'])->group(static function (): void {
    Route::post('/validations', [ValidationController::class, 'store']);
});
