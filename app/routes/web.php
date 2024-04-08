<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/login', function () {
    return view('pages.auth.login');
});
Route::get('/register', function () {
    return view('pages.auth.register');
});
Route::get('/dashboard', function () {
    return view('pages.dashboard.users');
});
Route::get('/dashboard/users', function () {
    return view('pages.dashboard.users');
});
Route::get('/dashboard/roles', function () {
    return view('pages.dashboard.roles');
});
