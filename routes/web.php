<?php

use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\LeavesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::match(['get','post'],'/register',[AuthController::class,'register'])->name('register');
Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');
Route::POST('/login',[AuthController::class,'login'])->name('login-home');
Route::GET('/logout',[AuthController::class,'logout'])->name('logout');

Route::group(['middleware' => 'useradmin'],function(){
    Route::GET('calender',[LeavesController::class,'index'])->name('calendar.index');
    Route::POST('calender/store',[LeavesController::class,'store'])->name('calendar.store');
    Route::POST('calender/delete',[LeavesController::class,'destroy'])->name('calendar.delete');
    Route::POST('calender/admin/reject',[LeavesController::class,'reject'])->name('calendar.admin.reject');
    Route::POST('calender/admin/revert',[LeavesController::class,'revert'])->name('calendar.admin.revert');
    Route::POST('calender/admin/approve',[LeavesController::class,'approve'])->name('calendar.admin.approve');
    Route::POST('admin/notification',[LeavesController::class,'notification'])->name('admin.notification');

//     Route::GET('role',[RoleController::class,'list'])->name('role.list');
//     Route::GET('role/add',[RoleController::class,'add'])->name('role.add');
//     Route::POST('role/add',[RoleController::class,'insert'])->name('role.insert');
//     Route::GET('role/edit/{id}',[RoleController::class,'edit'])->name('role.edit');
//     Route::POST('role/edit/{id}',[RoleController::class,'update'])->name('role.update');
//     Route::GET('role/delete/{id}',[RoleController::class,'delete'])->name('role.delete');
});
