<?php

use Illuminate\Support\Facades\Route;

// Public authentication entry points.
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register');

Auth::routes();

// Authenticated student flow.
Route::group(['middleware' => ['auth']], function () {
    Route::get('/approval', [App\Http\Controllers\HomeController::class, 'approval'])->name('approval');
    Route::post('/approval-rev', [App\Http\Controllers\HomeController::class, 'rav_payment'])->name('approval-rev');

    Route::middleware(['approved'])->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
        Route::post('/profile-edit', [App\Http\Controllers\HomeController::class, 'profile_edit'])->name('profile-edit');

        Route::get('/examination', [App\Http\Controllers\personal\ExaminationController::class, 'index'])->name('examination');
        Route::get('/exam-start/{examid}', [App\Http\Controllers\personal\ExaminationController::class, 'exam_start'])->name('exam-start');
        Route::get('/exam-start/{examid}/{page}', [App\Http\Controllers\personal\ExaminationController::class, 'exam_start_page'])->name('exam-start');
        Route::post('/select-option', [App\Http\Controllers\personal\ExaminationController::class, 'select_option'])->name('select-option');
        Route::get('/exam-result', [App\Http\Controllers\personal\ExaminationController::class, 'exam_result'])->name('exam-result');

        Route::get('/documents', [App\Http\Controllers\personal\DocumentController::class, 'index'])->name('documents');
        Route::get('/post/{postid}', [App\Http\Controllers\PostController::class, 'post_listing'])->name('post');
    });
});

// Admin product management surface.
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/dashboard', [App\Http\Controllers\admin\AdminController::class, 'index'])->name('dashboard');

        Route::get('/personal', [App\Http\Controllers\admin\PersonalController::class, 'index'])->name('personal');
        Route::post('/personal-get', [App\Http\Controllers\admin\PersonalController::class, 'personal_feed'])->name('personal-get');
        Route::post('/personal-edit', [App\Http\Controllers\admin\PersonalController::class, 'personal_edit'])->name('personal-edit');
        Route::post('/personal-create', [App\Http\Controllers\admin\PersonalController::class, 'personal_create'])->name('personal-create');

        Route::get('/exam', [App\Http\Controllers\admin\ExamController::class, 'index'])->name('admin.exam');
        Route::post('/exam-get', [App\Http\Controllers\admin\ExamController::class, 'exam_feed'])->name('exam-get');
        Route::post('/exam-create', [App\Http\Controllers\admin\ExamController::class, 'exam_create'])->name('exam-create');

        Route::get('/question', [App\Http\Controllers\admin\QuestionController::class, 'index'])->name('admin.question');
        Route::post('/question-get', [App\Http\Controllers\admin\QuestionController::class, 'question_feed'])->name('question-get');
        Route::post('/question-create', [App\Http\Controllers\admin\QuestionController::class, 'question_create'])->name('question-create');

        Route::get('/document-manager', [App\Http\Controllers\admin\DocumentController::class, 'index'])->name('admin.document-manager');
        Route::post('/document-get', [App\Http\Controllers\admin\DocumentController::class, 'doc_feed'])->name('document-get');

        Route::get('/result', [App\Http\Controllers\admin\ResultController::class, 'index'])->name('admin.result');
        Route::post('/result-get', [App\Http\Controllers\admin\ResultController::class, 'result_feed'])->name('result-get');
        Route::post('/result-get-anly', [App\Http\Controllers\admin\ResultController::class, 'result_anly_feed'])->name('result-get-anly');
    });
});
