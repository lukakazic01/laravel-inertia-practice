<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/users', [UserController::class, 'index'])->middleware('auth');
Route::get('/users/create', [UserController::class, 'create'])->middleware('auth')->can('create', User::class);
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->middleware('auth')->can('edit', 'user');
Route::post('/users', [UserController::class, 'store'])->middleware('auth');
Route::patch('/users/{user}', [UserController::class, 'update'])->middleware('auth')->can('edit', 'user');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('auth')->can('edit', 'user');

Route::get('/', function () {
    return Inertia::render('Home');
})->middleware('auth');

Route::get('/settings', function () {
    return Inertia::render('Settings');
})->middleware('auth');

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');
