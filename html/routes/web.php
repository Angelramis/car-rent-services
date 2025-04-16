<?php

use App\Livewire\CarList;
use App\Livewire\CarTest;
use Illuminate\Support\Facades\Route;


Route::get('/', CarTest::class);

Route::get('/car-list', CarList::class);