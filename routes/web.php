<?php

use App\Livewire\Tryout;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' =>'auth'], function() {
    Route::get('/do-tryout', Tryout::class)->name("Tryout");
});


Route::get('/', function () {
    return view('welcome');
});
