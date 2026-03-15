<?php

use App\Http\Controllers\CerobongController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/cerobong', [CerobongController::class, 'apiIndex']);
    Route::get('/cerobong/{id}', [CerobongController::class, 'apiShow']);
    
    Route::get('/data', [DataController::class, 'apiIndex']);
    Route::get('/data/cerobong/{cerobong_id}', [DataController::class, 'apiByCerobong']);
    
    Route::get('/dashboard/stats', [DashboardController::class, 'apiStats']);
});
