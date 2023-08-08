<?php

use App\Http\Controllers\Moderator\ModeratorController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\User\UserController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('user')->name('user.')->group(function(){
    Route::middleware(['guest:web','preventBackHistory'])->group(function(){
          Route::view('/login','user.login')->name('login');
          Route::view('/register','user.register')->name('register');
          Route::post('/create',[UserController::class,'create'])->name('create');
          Route::post('/check',[UserController::class,'check'])->name('check');

    });
    Route::middleware(['auth'])->group(function(){
      Route::view('/home','user.home')->name('home');
      Route::post('/logout',[UserController::class,'logout'])->name('logout');
});
});

Route::prefix('superAdmin')->name('superAdmin.')->group(function(){
  Route::middleware(['guest:superAdmin','preventBackHistory'])->group(function(){
        Route::view('/login','superAdmin.login')->name('login');
        Route::view('/register','superAdmin.register')->name('register');
        Route::post('/create',[SuperAdminController::class,'create'])->name('create');
        Route::post('/check',[SuperAdminController::class,'check'])->name('check');

  });
  Route::middleware(['auth'])->group(function(){
    Route::view('/home','superAdmin.home')->name('home');
    Route::post('/logout',[SuperAdminController::class,'logout'])->name('logout');
});
});

Route::prefix('moderator')->name('moderator.')->group(function(){
  Route::middleware(['guest:moderator,preventBackHistory'])->group(function(){
        Route::view('/login','moderator.login')->name('login');
        Route::view('/register','moderator.register')->name('register');
        Route::post('/create',[ModeratorController::class,'create'])->name('create');
        Route::post('/check',[ModeratorController::class,'check'])->name('check');

  });
  Route::middleware(['auth'])->group(function(){
    Route::view('/home','moderator.home')->name('home');
    Route::post('/logout',[ModeratorController::class,'logout'])->name('logout');
});
});
