<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/logout', [HomeController::class, 'logout']);

Route::get('/',[HomeController::class,'home'])->name('index');
Route::get('/dashboard',[HomeController::class,'index'])->name('dashboard')->middleware('notlogin');
Route::get('/auth/login',[AuthController::class,'login'])->name('login');
Route::get('/auth/Register',[AuthController::class,'register'])->name('register');

Route::post('/auth/RegisterUser',[AuthController::class,'registerUser'])->name('registerUser');
Route::post('/auth/loginUser',[AuthController::class,'loginUser'])->name('loginUser');

Route::post('/addtask',[HomeController::class,'addtask'])->name('addtask')->middleware('notlogin');
Route::post('/edittask',[HomeController::class,'edittask'])->name('edittask')->middleware('notlogin');

Route::get('/delete/{id}',[HomeController::class,'delete'])->where(['id'=>'[0-9]+'])->name('delete')->middleware('notlogin');
