<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response([
        'status' => 1,
        'message' => 'success'
    ], 200);
});
