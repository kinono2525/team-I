<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

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

    Route::get('/attendance', function () {
        return view('attendance.create');
    })->name('attendance.create');

    Route::get('/students/search', function () {
        return view('students.search');
    })->name('students.search');

    Route::prefix('students/{student}')->group(function () {
        Route::resource('tests', TestController::class);
    });
});


require __DIR__.'/auth.php';
