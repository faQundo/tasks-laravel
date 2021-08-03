<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


/**
 * protected routes
 */
Route::group([
    'middleware' => 'auth',
    'prefix' => 'pages',
], function () {

});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/mail', [App\Http\Controllers\HomeController::class, 'test'])->name('test');

Route::resources([
    'tasks' => \App\Http\Controllers\TaskController::class,
    'logs' => \App\Http\Controllers\LogController::class,
]);
