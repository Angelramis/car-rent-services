<?php

use App\Livewire\CarTest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', CarTest::class);