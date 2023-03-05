<?php

use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('user', [UserController::class, 'register'])->name('register');
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user/{id}', [UserController::class, 'getUser'])->name('getUser');

    Route::group(['prefix' => 'post'], function () {
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::get('/{id}', [PostController::class, 'show'])->name('show');
        Route::post('/{id}/comment', [CommentController::class, 'storePostComment'])->name('comment.store');

    });

    Route::group(['prefix' => 'video'], function () {
        Route::post('/', [VideoController::class, 'store'])->name('video.store');
        Route::get('/{id}', [VideoController::class, 'show'])->name('show');
        Route::post('/{id}/comment', [CommentController::class, 'storeVideoComment'])->name('comment.store');

    });



});
