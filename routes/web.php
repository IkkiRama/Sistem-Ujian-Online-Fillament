<?php

use App\Livewire\TryoutOnline;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' =>'auth'], function() {
    Route::get('/do-tryout/{id}', TryoutOnline::class)->name("Tryout");
});


Route::get('/', function () {
    return view('welcome');
});
