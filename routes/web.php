<?php

use App\Http\Controllers\AdminAppointmentController;
use App\Http\Controllers\AdminAppointmentHistoryController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminGetAppointmentsController;
use App\Http\Controllers\AdminGetLabTestController;
use App\Http\Controllers\AdminLabTestsController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AppointmentHistoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GetAppointmentsController;
use App\Http\Controllers\GetLabTestController;
use App\Http\Controllers\LabTestsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SignoutController;
use App\Http\Controllers\TestPDFController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::resource('appointment', AdminAppointmentController::class)->middleware('auth');
    Route::resource('dashboard', AdminDashboardController::class)->middleware('auth');
    Route::resource('lab-test', AdminLabTestsController::class)->middleware('auth');
    Route::resource('get-appointments', AdminGetAppointmentsController::class);
    Route::resource('get-tests', AdminGetLabTestController::class)->middleware('auth');
    Route::resource('roles', RoleController::class)->middleware('auth');
    Route::resource('permissions', PermissionController::class)->middleware('auth');
    Route::resource('appointment-history', AdminAppointmentHistoryController::class)->middleware('auth');
    Route::resource('users', UserController::class)->middleware('auth');
});

Route::resource('login', LoginController::class); //login
Route::resource('register', RegisterController::class);//register
Route::resource('appointment', AppointmentController::class)->middleware('auth');
Route::resource('dashboard', DashboardController::class)->middleware('auth');
Route::resource('lab-test', LabTestsController::class)->middleware('auth');
Route::resource('get-appointments', GetAppointmentsController::class)->middleware('auth');
Route::resource('get-tests', GetLabTestController::class)->middleware('auth');
Route::resource('file-download', TestPDFController::class)->middleware('auth');
Route::resource('get-tests', GetLabTestController::class)->middleware('auth');
Route::resource('sign-out', SignoutController::class);
Route::resource('appointment-history', AppointmentHistoryController::class)->middleware('auth');
