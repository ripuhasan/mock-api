<?php

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

Route::apiResource('admin/user/info', Api\UserInfoController::class);
Route::apiResource('admin/v1/test', Api\TestController::class);
Route::apiResource('new/test', Api\NewTestController::class);
Route::apiResource('admin/blogs', Api\BlogController::class);
Route::apiResource('admin/user/info', Api\UserInfoController::class);
Route::apiResource('contact/info', Api\ContactController::class);
Route::apiResource('new/test', Api\NewTestController::class);
Route::apiResource('admin/v1/test', Api\TestController::class);
Route::apiResource('admin/blogs/new', Api\Blog1Controller::class);
Route::apiResource('admin/blogs', Api\BlogController::class);
Route::apiResource('contact/info', Api\ContactController::class);
Route::apiResource('new/test', Api\NewTestController::class);
Route::apiResource('admin/blogs', Api\BlogController::class);
