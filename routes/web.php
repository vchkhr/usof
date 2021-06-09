<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('edit');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');
Route::delete("/profile/{id}/profile", [App\Http\Controllers\ProfilesController::class, 'destroy'])->name('profile.destroy');

Route::get("/question/create", [App\Http\Controllers\QuestionsController::class, 'create']);
Route::get("/question/{question}", [App\Http\Controllers\QuestionsController::class, 'show']);
Route::post("/question", [App\Http\Controllers\QuestionsController::class, 'store']);
Route::get("/question/{question}/edit", [App\Http\Controllers\QuestionsController::class, 'edit'])->name('edit');
Route::delete("/question/{id}/delete", [App\Http\Controllers\QuestionsController::class, 'destroy'])->name('question.destroy');
Route::patch('/question/{question}', [App\Http\Controllers\QuestionsController::class, 'update'])->name('question.update');

Route::get("/answer/create", [App\Http\Controllers\AnswersController::class, 'create']);
Route::post("/answer", [App\Http\Controllers\AnswersController::class, 'store']);
Route::get("/answer/{answer}/edit", [App\Http\Controllers\AnswersController::class, 'edit'])->name('edit');
Route::delete("/answer/{id}/delete", [App\Http\Controllers\AnswersController::class, 'destroy'])->name('answer.destroy');
Route::patch('/answer/{answer}', [App\Http\Controllers\AnswersController::class, 'update'])->name('answer.update');

Route::get("/like/create", [App\Http\Controllers\LikesController::class, 'create']);
Route::post("/like", [App\Http\Controllers\LikesController::class, 'store']);

Route::get("/tag/{tag}", [App\Http\Controllers\TagsController::class, 'show']);
