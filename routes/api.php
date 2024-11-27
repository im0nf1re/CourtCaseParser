<?php

use App\Http\Controllers\CourtCaseController;
use Illuminate\Support\Facades\Route;

Route::get('/cases', [CourtCaseController::class, 'getCases']);
