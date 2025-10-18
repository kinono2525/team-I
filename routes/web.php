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
    Route::get('/wrong-questions', [WrongQuestionController::class, 'index'])->name('wrong_questions.index');
    Route::post('/wrong-questions', [WrongQuestionController::class, 'store'])->name('wrong_questions.store');
    Route::get('/attendance', [AttendanceController::class, 'create'])->name('attendance.create');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('/students/search', [StudentController::class, 'search'])->name('students.search');

    Route::prefix('students/{student}')->group(function () {
        Route::resource('tests', TestController::class);
    });
});


require __DIR__.'/auth.php';
