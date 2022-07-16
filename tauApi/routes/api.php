<?php
namespace App\Http\Controllers;
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

Route::post('/login', [AuthController::class, 'login']);
Route::get('/posts', [CommentController::class, 'getPosts']);
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/post-comment', [CommentController::class, 'postComment']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/my-profile', [AuthController::class, 'getProfile']);
});