<?php

use App\Http\Controllers\CarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/cars', CarController::class);
Route::get('/cars/car/{name}', [CarController::class, 'findByName']);
