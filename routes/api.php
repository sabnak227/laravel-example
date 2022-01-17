<?php

use App\Http\Controllers\PostController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/post/{post}/user-id-only', [PostController::class, 'userIdOnly']);
Route::get('/post/service-container', [PostController::class, 'serviceContainer']);
Route::get('/post/{post}/event', [PostController::class, 'event']);
Route::get('/post/{post}/queue', [PostController::class, 'queue']);
Route::resource('/post', PostController::class)->except('edit', 'create');
