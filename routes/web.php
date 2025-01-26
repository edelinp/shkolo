<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Assignment;
use App\Livewire\ConfigureButton;

Route::get('/', Assignment::class)->name('assignment');
Route::get('/configure/{id}', ConfigureButton::class)->name('button.configure');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
