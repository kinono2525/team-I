<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WrongQuestionController;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/students/search', [StudentController::class, 'search'])->name('students.search');
    Route::resource('students', StudentController::class);
    Route::get('/students/{student}/detail', [StudentController::class, 'detail'])->name('students.detail');
    Route::prefix('students/{student}')->group(function () {
        Route::resource('attendances', AttendanceController::class);
        Route::resource('tests', TestController::class);
        Route::resource('wrong_questions', WrongQuestionController::class)->only(['index','store']);
    });
});


require __DIR__.'/auth.php';
