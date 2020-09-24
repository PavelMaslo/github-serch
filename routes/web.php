<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RepositoryController;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/repositories', [RepositoryController::class, 'getFavorit']);
Route::get('/repositories', [RepositoryController::class, 'index']);
Route::delete('/repositories', [RepositoryController::class, 'destroyByUrl']);
Route::get('/repositories/create', [RepositoryController::class, 'create']);
Route::get('/repositories/search/{q?}', [RepositoryController::class, 'searchFromGithub']);




