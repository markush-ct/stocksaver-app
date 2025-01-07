<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');


Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('dashboard', 'pages.dashboard.overview')->name('dashboard');
    Volt::route('category', 'pages.dashboard.category.index')->name('category.index');
    Volt::route('category/create', 'pages.dashboard.category.create')->name('category.create');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
