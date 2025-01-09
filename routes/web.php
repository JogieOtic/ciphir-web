<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NotificationController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;

Route::get('/', [MainController::class, 'main'])->name('page.main');
// Route::get('/notification', [MainController::class, 'notification'])->name('page.notification');

// login verifications
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:web'])->group(function () {
  Route::get('/sa-dashboard', [SuperAdminController::class, 'index'])->name('sa.dashboard');
  // client routes
  Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
  Route::get('/newreport', [AdminController::class, 'newreport'])->name('newreport');
  Route::get('/reportdetail/{id}', [MainController::class, 'reportdetail'])->name('page.reportdetail');
  Route::get('/priorityreport', [AdminController::class, 'showPriorityReports'])->name('priorityreport');
  Route::get('/reporthistory', [AdminController::class, 'reporthistory'])->name('reporthistory');
  Route::get('/map-view/{id}', [AdminController::class, 'location'])->name('map.location');
  Route::patch('/update-report-status', [AdminController::class, 'updateReportStatus'])->name('updateReportStatus');
  Route::get('/profile/{id}/edit', [AdminController::class, 'profile'])->name('admin.profile');
  Route::patch('/change-username', [AdminController::class, 'changeUsername'])->name('change-username');
  Route::patch('/change-password', [AdminController::class, 'changePassword'])->name('change-password');
});

// Unauthorized Access for not Authenticated users
Route::get('/unauthorized', [MainController::class, 'unauthorized']);

// Redirect to login with `next` parameter if unauthenticated
Route::get('/sa-dashboard', [SuperAdminController::class, 'index'])->name('sa.dashboard');

Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// Route::get('/db-check', function () {
//     try {
//         DB::connection()->getPdo();
//         return 'Connected to database successfully!';
//     } catch (\Exception $e) {
//         return 'Connection failed: ' . $e->getMessage();
//     }
// });
