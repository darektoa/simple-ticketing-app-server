<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/addons', [AddonController::class, 'index']);
Route::get('/destinations', [DestinationController::class, 'index']);

Route::prefix('tickets')->group(function() {
    Route::post('/', [TransactionController::class, 'store']);
});