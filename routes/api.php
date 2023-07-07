<?php

use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('post-registration', [\App\Http\Controllers\AuthController::class, 'postRegistration'])->name('register.post');
Route::get('allstudents',[StudentController::class,'getstudents'])->name('allstudents');
Route::delete('allstudents/{id}',[StudentController::class,'removeStudent'])->name('student.delete');
Route::patch('allstudents/{id}',[StudentController::class,'update'])->name('student.update');
Route::get('/student/{id}/edit',[StudentController::class,'edit'])->name('student.edit');
Route::post('registermarks',[StudentController::class,'addmarks'])->name('student.addmarks');
Route::get('studentperformances',[StudentController::class,'getallmarks'])->name('student.marks');
Route::get('studentperformances/{id}', [\App\Http\Controllers\StudentController::class, 'viewPerformanceofStudent'])->name('student.performance');
Route::delete('studentperformances/{id}', [\App\Http\Controllers\StudentController::class, 'removemarks'])->name('student.removemarks');
Route::patch('studentperformance', [\App\Http\Controllers\StudentController::class, 'UpdateMarks'])->name('students.performance.update');
