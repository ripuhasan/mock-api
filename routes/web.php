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
   
    Route::get('mock-api-edit/{id}', [App\Http\Controllers\Admin\MockApiController::class, 'MockApiEdit'])->name('mock.api.edit');
    Route::put('mock-api-update/{id}', [App\Http\Controllers\Admin\MockApiController::class, 'MockApiUpdate'])->name('mock.api.update');
    Route::delete('mock-api-destroy/{id}', [App\Http\Controllers\Admin\MockApiController::class, 'MockApiDestroy'])->name('mock.api.destroy');

    Route::get('custom-mock-api', [App\Http\Controllers\Admin\CustomMockApiController::class, 'customMockApi'])->name('custom.mock.api');
    Route::get('custom-mock-api-list', [App\Http\Controllers\Admin\CustomMockApiController::class, 'customMockApiList'])->name('custom.mock.api.list');
    Route::post('custom-mock-api', [App\Http\Controllers\Admin\CustomMockApiController::class, 'customMockApiStore'])->name('custom.mock.api.store');

});
