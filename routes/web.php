<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;

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

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('change-password', [AuthController::class, 'showChangePasswordForm'])->name('user.showpassword');
Route::post('change-password', [AuthController::class, 'changePassword'])->name('password.update');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('students', [\App\Http\Controllers\StudentController::class, 'index'])->name('students');
Route::get('studentperformance', [\App\Http\Controllers\StudentController::class, 'viewPerformancePage'])->name('students.performance');



