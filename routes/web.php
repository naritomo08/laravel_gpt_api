<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::inertia('/', 'Dashboard');

Route::get('/article', [ArticleController::class, 'index'])->name('article.index');
Route::get('/article/list', [ArticleController::class, 'list'])->name('article.list');
