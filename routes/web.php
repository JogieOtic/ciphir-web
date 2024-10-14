<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NotificationController;


Route::get('/', [MainController::class, 'main'])->name('page.main');
Route::get('/login', [MainController::class, 'login'])->name('page.login');
Route::post('/login', [MainController::class, 'submit'])->name('login.submit');
Route::get('/dashboard', [MainController::class, 'dashboard'])->name('page.dashboard');
Route::get('/profile', [MainController::class, 'profile'])->name('page.profile');
Route::post('/profile/update', [MainController::class, 'updateProfile'])->name('profile.update');
Route::get('/newreport', [MainController::class, 'newreport'])->name('page.newreport');
Route::get('/priorityreport', [MainController::class, 'showPriorityReports'])->name('page.priorityreport');
Route::get('/reporthistory', [MainController::class, 'reporthistory'])->name('page.reporthistory');
Route::get('/reporthistory', [MainController::class, 'reporthistory'])->name('reporthistory');
Route::get('/notification', [MainController::class, 'notification'])->name('page.notification');
Route::get('/reportdetail/{id}', [MainController::class, 'reportdetail'])->name('page.reportdetail');
Route::post('/reportdetail/{id}/updateStatus', [MainController::class, 'updateStatus'])->name('page.updateStatus');
Route::post('/report/{id}/update-status', [MainController::class, 'updateStatus'])->name('page.updateStatus');

// Route::get('/db-check', function () {
//     try {
//         DB::connection()->getPdo();
//         return 'Connected to database successfully!';
//     } catch (\Exception $e) {
//         return 'Connection failed: ' . $e->getMessage();
//     }
// });
