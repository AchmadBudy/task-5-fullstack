<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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



Route::middleware(['auth'])->group(function () {
    Route::get('/post/create', [PostController::class, 'index'])->name('make_post');
    Route::post('/post/create', [PostController::class, 'createPost'])->name('post_post');
    Route::get('/category/create', [CategoryController::class, 'index'])->name('make_category');
    Route::post('/category/create', [CategoryController::class, 'createCategory'])->name('post_category');
});


Route::get('/', [HomeController::class, 'index'])->middleware('guest');
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('guest');
Route::get('/post/{id}', [HomeController::class, 'detailPost'])->name('detail_post');

Auth::routes();
