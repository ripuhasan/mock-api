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
Route::apiResource('admin/user/info', Api\InfoController::class);
Route::apiResource('admin/v1/test', Api\TestController::class);
Route::apiResource('admin/user/info/data/user-info', Api\UserInfoController::class);
Route::apiResource('admin/user/info', Api\InfoController::class);
Route::apiResource('admin/user/info', Api\InfoController::class);
Route::apiResource('admin/v1/users', Api\UsersController::class);
Route::apiResource('admin/user/info', Api\InfoController::class);
Route::apiResource('admin/v1/users/test', Api\TestController::class);
Route::apiResource('admin/user/info', Api\InfoController::class);
Route::apiResource('admin/v1/users', Api\UsersController::class);
Route::apiResource('admin/user/info', Api\InfoController::class);
Route::apiResource('admin/v1/test', Api\TestController::class);
Route::apiResource('admin/blogs', Api\BlogsController::class);
Route::apiResource('admin/user/info', Api\InfoController::class);
Route::apiResource('admin/user/info', Api\InfoController::class);
Route::apiResource('admin/user/info', Api\InfoController::class);
Route::apiResource('admin/user/info', Api\InfoController::class);
Route::apiResource('admin/v1/test', Api\TestController::class);
Route::apiResource('admin/v1/users', Api\UsersController::class);
Route::apiResource('admin/user/info', Api\InfoController::class);
Route::apiResource('admin/v1/users', Api\UsersController::class);
Route::apiResource('admin/user/info', Api\InfoController::class);
Route::apiResource('admin/blogs', Api\BlogsController::class);
Route::apiResource('admin/v1/users', Api\UsersController::class);
Route::apiResource('admin/v1/test', Api\TestController::class);
Route::apiResource('admin/user/info', Api\InfoController::class);
Route::apiResource('admin/v1/users', Api\UsersController::class);
