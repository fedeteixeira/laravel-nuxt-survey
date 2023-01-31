<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/answers', [AnswerController::class, 'store']);
Route::get('/answers', [AnswerController::class, 'index']);
Route::get('/answers/average', [AnswerController::class, 'average']);
Route::middleware(['auth:sanctum', 'admin'])->get('/answers/unanswered', [AnswerController::class, 'usersWithoutAnswers']);

Route::post('/questions', [QuestionController::class, 'store']);
Route::get('/questions', [QuestionController::class, 'index']);

