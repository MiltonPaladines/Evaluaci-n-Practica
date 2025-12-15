<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Ruta del formulario de login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Ruta del dashboard (protegida en el cliente con JavaScript)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
