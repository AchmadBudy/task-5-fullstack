<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('/v1')->middleware('auth:api')->group(function () {
    // route login
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // route Post
    Route::post('/post', [PostController::class, 'getAllPost']);
    Route::post('/post/{id}', [PostController::class, 'getAllPostById']);
    Route::post('/post/{id}/update', [PostController::class, 'updatePost']);
    Route::post('/post/{id}/delete', [PostController::class, 'deletePost']);
    Route::post('/post/insert', [PostController::class, 'insertPost']);

    // route Post
    Route::post('/category', [CategoryController::class, 'getAllCategory']);
    Route::post('/category/insert', [CategoryController::class, 'createCategory']);
});
