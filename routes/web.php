<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WrongQuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/wrong-questions', [WrongQuestionController::class, 'index'])->name('wrong_questions.index');
    Route::post('/wrong-questions', [WrongQuestionController::class, 'store'])->name('wrong_questions.store');
    Route::get('/wrong-questions/pdf', [WrongQuestionController::class, 'pdf'])->name('wrong_questions.pdf');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
