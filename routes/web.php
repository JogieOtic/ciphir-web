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
  Route::patch('/edit/{id}', [SuperAdminController::class, 'editAdministrator'])->name('sa.editAdmin');
  Route::patch('/reset-password', [SuperAdminController::class, 'resetPassword'])->name('sa.resetPassword');
  
  Route::prefix('/manage-all-users')->group(function () {
    Route::get('/administrators', [SuperAdminController::class, 'getAdministrators'])->name('administrators');
    Route::get('/residents', [SuperAdminController::class, 'getResidents'])->name('residents');
  });
  Route::prefix('/manage')->group(function () {
    Route::get('/issues', [SuperAdminController::class, 'getIssues'])->name('issues');

    Route::get('/infrastructures', [SuperAdminController::class, 'getInfrastructures'])->name('infrastructures');
  });

  
  Route::delete('/delete/{id}', [SuperAdminController::class, 'delete'])->name('sa.delete');
  Route::delete('/delete/issue/{id}', [SuperAdminController::class, 'deleteIssue'])->name('sa.deleteIssue');
  Route::delete('/delete/infrastructure/{id}', [SuperAdminController::class, 'deleteInfrastructure'])->name('sa.deleteInfrastructure');

  Route::post('/add-new-issue', [SuperAdminController::class, 'addNewIssue'])->name('addNewIssue');
  Route::patch('/update-issue/{id}', [SuperAdminController::class, 'updateIssue'])->name('sa.updateIssue');
  Route::patch('/update-infrastructure/{id}', [SuperAdminController::class, 'updateInfrastructure'])->name('sa.updateInfrastructure');

  Route::post('/add-new-infrastructure', [SuperAdminController::class, 'addNewInfrastructure'])->name('addNewInfrastructure');
  Route::post('/add-new-admin', [SuperAdminController::class, 'addNewAdmin'])->name('sa.addNewAdmin');


  Route::get('/sa-profile', [SuperAdminController::class, 'saProfile'])->name('sa.profile');
  Route::patch('/sa-change-username', [SuperAdminController::class, 'changeUsername'])->name('saChangeUsername');
  Route::patch('/sa-change-password', [SuperAdminController::class, 'changePassword'])->name('saChangePassword');
  

  // Route::patch('/infrastructures/{id}/edit', [SuperAdminController::class, 'updateInfrastructures'])->name('edit.infrastructures');

  // client routes
  Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
  Route::get('/newreport', [AdminController::class, 'newreport'])->name('newreport');
  Route::get('/reportdetail/{id}', [MainController::class, 'reportdetail'])->name('page.reportdetail');
  Route::get('/priorityreport', [AdminController::class, 'showPriorityReports'])->name('priorityreport');
  Route::get('/reporthistory', [AdminController::class, 'reporthistory'])->name('reporthistory');
  Route::get('/map-view/{id}', [AdminController::class, 'location'])->name('map.location');
  Route::get('/profile/{id}/edit', [AdminController::class, 'profile'])->name('admin.profile');

  // superadmin
  // Route::patch('/issues/{id}/edit', [SuperAdminController::class, 'updateIssues'])->name('edit.issues');
  // Route::patch()->name('edit.infrastructures');

  // admin
  Route::patch('/update-report-status', [AdminController::class, 'updateReportStatus'])->name('updateReportStatus');
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
