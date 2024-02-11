<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;

Route::get('/', [AttendanceController::class, 'index'])->middleware('auth');
Route::post('/workStart', [AttendanceController::class, 'workStart']);
Route::post('/workEnd', [AttendanceController::class, 'workEnd']);
Route::post('/breakStart', [AttendanceController::class, 'breakStart']);
Route::post('/breakEnd', [AttendanceController::class, 'breakEnd']);
Route::get('/logout', [AttendanceController::class, 'login']);
Route::get('/date', [AttendanceController::class, 'date']);
Route::get('/alldate', [AttendanceController::class, 'alldate']);


require __DIR__.'/auth.php';
