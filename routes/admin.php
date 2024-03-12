<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MainCategoryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

//////////////////////////// admin prefix //////////////////////////////

Route::get('/login',[AuthController::class, 'getLogin'])->name('admin.getLogin');
Route::post('/login',[AuthController::class, 'login'])->name('admin.login');
Route::post('/logout',[AuthController::class, 'logout'])->name('admin.logout');

Route::get('/forgot-password', [AuthController::class, 'forgot_password'])->name('forgot_password');


Route::middleware('auth:admin')->group(function () {

    Route::get('/dashboard',[DashboardController::class, 'index'])->name('admin.dashboard');


    Route::get('/users',[UserController::class, 'index'])->name('admin.users');
    Route::get('/user/create',[UserController::class, 'create'])->name('admin.user.create');
    Route::get('/users/edit/{id}',[UserController::class, 'edit'])->name('admin.user.edit');
    Route::post('/users/update/{id}',[UserController::class, 'update'])->name('admin.user.update');
    Route::get('/users/destroy/{id}',[UserController::class, 'destroy'])->name('admin.user.destroy');


    Route::get('profile', [ProfileController::class, 'edit']) -> name('admin.profile.edit') ;
    Route::post('profile', [ProfileController::class, 'update']) -> name('admin.profile.update') ;
    Route::post('profile/passwordchange', [ProfileController::class, 'changePassword']) -> name('admin.profile.changePassword') ;
    Route::get('profile/destroy', [ProfileController::class, 'confirmDelete']) -> name('admin.profile.confirmDelete') ;
    Route::post('profile/destroy', [ProfileController::class, 'destroy']) -> name('admin.profile.destroy') ;


    Route::resource('mainCategories', MainCategoryController::class);
    Route::resource('subCategories', SubCategoryController::class);
});
