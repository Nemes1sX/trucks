<?php

use App\Http\Controllers\SubUnitController;
use App\Http\Controllers\TruckController;
use Illuminate\Support\Facades\Route;

Route::apiResource('trucks', TruckController::class);
Route::apiResource('subunits', SubUnitController::class);