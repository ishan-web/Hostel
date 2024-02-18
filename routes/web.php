<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\permissioncategoryController;
use App\Http\Controllers\permissionController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\AllocateController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);
Auth::routes();

Route::middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard',[dashboardController::class, 'index']);
    Route::resource('percategory', permissioncategoryController::class);
    Route::resource('permission', permissionController::class);
    Route::resource('roles', roleController::class);
    Route::resource('users', UserController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('room', RoomController::class);
    Route::resource('type', RoomTypeController::class);
    Route::resource('allocate', AllocateController::class);
    Route::resource('student', StudentController::class);

});

Route::middleware(['auth','isDriver'])->group(function(){
    Route::get('/homes',[dashboardController::class, 'index']);
});

