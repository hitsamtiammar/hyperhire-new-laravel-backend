<?php

use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/view-root', [MenuController::class, 'viewRoot']);
    Route::get('view-data/{id}', [MenuController::class, 'index']);
    Route::post('/add', [MenuController::class, 'create']);
    Route::put('/update/{id}', [MenuController::class, 'update']);
    Route::delete('/delete/{id}', [MenuController::class, 'destroy']);
});
