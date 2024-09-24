<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\QuizController;
use App\Models\Quiz;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\VocabularyController;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\WelcomeController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/auth/google', [App\Http\Controllers\GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [App\Http\Controllers\GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::get('/video/{id}', [VideoController::class, 'show']);
Route::get('/quiz/{id}', [QuizController::class, 'show']);
// Route cho hồ sơ
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

// Route cho cài đặt
Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

// Route::get('/', function () {
//     // Truy vấn tất cả các bài học từ bảng lessons
//     $lessons = Lesson::all();

//     // Truyền dữ liệu vào view 'welcome'
//     return view('welcome', compact('lessons'));
// });
Route::get('/', [WelcomeController::class, 'index']);
Route::post('/submit-answer', [QuizController::class, 'submitAnswer']);

// CRUD routes for lesson management
Route::get('/qlLesson', [LessonController::class, 'showLessonsForManagement'])->name('qlLesson');
Route::get('/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');
Route::get('/lessons/{lesson}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');
