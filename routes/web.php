<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');


Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('dashboard', 'pages.dashboard.overview')->name('dashboard');
    Volt::route('category', 'pages.dashboard.category.index')->name('category.index');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
