<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'main'])->name('page.main');
Route::get('/login', [MainController::class, 'login'])->name('page.login');
Route::post('/login', [MainController::class, 'submit'])->name('login.submit'); // POST route for login
Route::get('/dashboard', [MainController::class, 'dashboard'])->name('page.dashboard');
Route::get('/profile', [MainController::class, 'profile'])->name('page.profile');
Route::get('/newreport', [MainController::class, 'newreport'])->name('page.newreport');
Route::get('/priorityreport', [MainController::class, 'priorityreport'])->name('page.priorityreport');
Route::get('/reporthistory', [MainController::class, 'reporthistory'])->name('page.reporthistory');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });