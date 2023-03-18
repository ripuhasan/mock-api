<?php

use Illuminate\Support\Facades\Route;
// use Admin\MockApiController;
use Admin\RoleController;
use Admin\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    // Roles And Permission Routes
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::get('/mock-api-build', [App\Http\Controllers\Admin\MockApiController::class, 'mockApi'])->name('mock.api');
    Route::get('/mock-api-list', [App\Http\Controllers\Admin\MockApiController::class, 'mockApiList'])->name('mock.api.list');
    Route::post('/mock-api-build', [App\Http\Controllers\Admin\MockApiController::class, 'mockApiStore'])->name('mock.api');

});
