<?php

use App\Http\Controllers\CarController;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

// rutas?


Route::get('/', Home::class);
Route::post('/car-list', [CarController::class, 'searchCars'])->name('car-list');