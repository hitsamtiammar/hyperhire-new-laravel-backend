<?php

use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/view-root', [MenuController::class, 'viewRoot'])->name('view-root');
    Route::get('view-data/{id}', [MenuController::class, 'index'])->name('view-menu');
    Route::post('/add', [MenuController::class, 'create'])->name('add-menu');
    Route::put('/update/{id}', [MenuController::class, 'update'])->name('update-menu');
    Route::delete('/delete/{id}', [MenuController::class, 'destroy'])->name('delete-menu');
});
