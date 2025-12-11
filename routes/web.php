<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('articles', ArticleController::class)->except('show');
Route::put('articles1/{article}', [ArticleController::class, 'updateRapido'])->name('articles.updaterapido');

