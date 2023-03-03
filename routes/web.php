<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/',[HomeController::class, 'login'])->name('login');
Route::get('/new',[HomeController::class, 'new'])->name('new');
Route::post('/home',[HomeController::class, 'home'])->name('home');
Route::get('/home',[HomeController::class, 'home'])->name('home2');
Route::get('/home/edit',[HomeController::class, 'home_edit'])->name('home_edit');
Route::get('/home/new',[HomeController::class, 'home_new'])->name('home_new');
//Route::get('/home/new', function () {
//    return view('edit');
//});
