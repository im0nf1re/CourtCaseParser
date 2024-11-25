<?php

use App\Http\Controllers\CourtCaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/cases/today', [CourtCaseController::class, 'getForToday']);
Route::get('/case/interval', [CourtCaseController::class, 'getForDateInterval']);
