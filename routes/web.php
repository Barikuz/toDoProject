<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//test routes
Route::get('testTemplate',[AppController::class,'main'])->name('main');

Route::post('testTemplate',[AppController::class,'store'])->name('store');

Route::get('categories',[CategoryController::class,'categories'])->name('categories');

Route::get('create',[CategoryController::class,'create'])->name('create_categories');

Route::post('add',[CategoryController::class,'add'])->name('add_category');

Route::get('update/{id}',[CategoryController::class,'update'])->name('update_categories');

Route::post('remake',[CategoryController::class,'remake'])->name('remake_category');

Route::get('delete/{id}',[CategoryController::class,'delete'])->name('delete_categories');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

