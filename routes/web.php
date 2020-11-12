<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
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

Route::get('/', [PostController::class, 'index'])->name('home')->middleware('auth');


Route::resource('posts', PostController::class)->middleware('auth');
Route::get('posts/{id}/delete', [PostController::class, 'delete'])->middleware('auth');

Route::get('users/login', [AuthController::class, 'login'])->name('login');
Route::post('users/login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('users/register', [AuthController::class, 'register'])->name('postRegister');
Route::post('users/postRegister', [AuthController::class, 'postRegister'])->name('postRegister');
Route::get('users/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('users/my_posts', [AuthController::class, 'my_posts'])->name('my_posts')->middleware('auth');