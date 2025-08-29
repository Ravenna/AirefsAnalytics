<?php

use Illuminate\Support\Facades\Route;
use Ravenna\AirefsAnalytics\Http\Controllers\ArCpController;

Route::middleware(['statamic.cp.authenticated'])
    ->prefix('airefs-analytics')
    ->name('airefs-analytics.')
    ->group(function () {
        // CP pages
        Route::get('/', [ArCpController::class, 'index'])->name('index');
    });