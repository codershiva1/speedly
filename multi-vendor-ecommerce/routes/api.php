<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SearchController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| These routes are loaded by the RouteServiceProvider
| and are assigned the "api" middleware group.
| They are prefixed with /api
|--------------------------------------------------------------------------
*/

Route::middleware('throttle:60,1')->group(function () {

    // 🔍 Live Search (Products + Categories)
    Route::get('/search', [SearchController::class, 'search']);


});
