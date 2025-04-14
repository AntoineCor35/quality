<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('clients.index');
});


Route::resource('clients', App\Http\Controllers\ClientController::class);
