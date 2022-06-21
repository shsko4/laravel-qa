<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\AcceptAnswerController;

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
Route::resource('questions', QuestionsController::class)->except('show');

//Route::post('/questions/{question}/answers',[AnswerController::class,'store'])->name('answers.store');
Route::resource('questions.answers',AnswerController::class)->except(['index','show','create']);
Route::get('/questions/{slug}',[QuestionsController::class,'show'])->name('questions.show');

Route::post('/answers/{answer}/accept',AcceptAnswerController::class)->name('answers.accept');

Route::post('/questions/{question}/favorites',[FavoritesController::class,'store'])->name('questions.favorite');
Route::delete('/questions/{question}/favorites',[FavoritesController::class,'destroy'])->name('questions.unfavorite');
