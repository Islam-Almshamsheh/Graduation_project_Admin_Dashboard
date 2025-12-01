<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\User\PostController as UserPostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StudentController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Default login & register routes added after requiring laravel/uI
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/show/{post}', [App\Http\Controllers\HomeController::class, 'show'])->name('post.show');
Route::view('/about','pages.about')->name('about');

Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/statistics', 'admin.statistics')->name('admin.statistics');
    Route::resource('posts', AdminPostController::class, ['as' => 'admin']);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
});


    Route::get('', [StudentController::class, 'index'])->name('students.index');
    Route::get('/student',[StudentController::class,'create'])->name('students.create');
    Route::post('',[StudentController::class,'store'])->name('students.store');
    Route::get('/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::get('/{student}', [StudentController::class, 'show'])->name('students.show');
    Route::delete('/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('',[AdminPostController::class, 'index'])->name('index');
    Route::get('/post',[AdminPostController::class, 'create'])->name('create');
    Route::post('',[AdminPostController::class, 'store'])->name('store');
    Route::get('/{post}/edit',[AdminPostController::class,'edit'])->name('edit');
    Route::put('/{post}',[AdminPostController::class, 'update'])->name('update');
    Route::get('/{post}',[AdminPostController::class,'show'])->name('show');
    Route::delete('/{post}',[AdminPostController::class,'destroy'])->name('destroy');
});

Route::prefix('categories')->group( function(){
    Route::get('',[CategoryController::class, 'index'])->name('categories.index');
    Route::get('/category',[CategoryController::class, 'create'])->name('categories.create');
    Route::post('',[CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{category}/edit',[CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/{category}',[CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{category}',[CategoryController::class,'destroy'])->name('categories.destroy');
});

Route::prefix('tags')->group( function(){
    Route::get('',[TagController::class, 'index'])->name('tags.index');
    Route::get('/tag',[TagController::class, 'create'])->name('tags.create');
    Route::post('',[TagController::class, 'store'])->name('tags.store');
    Route::get('/{tag}/edit',[TagController::class, 'edit'])->name('tags.edit');
    Route::put('/{tag}',[TagController::class, 'update'])->name('tags.update');
    Route::delete('/{tag}',[TagController::class,'destroy'])->name('tags.destroy');
});

Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('',[UserPostController::class, 'index'])->name('index');
    Route::get('/post',[UserPostController::class, 'create'])->name('create');
    Route::post('',[UserPostController::class, 'store'])->name('store');
    Route::get('/{post}/edit',[UserPostController::class,'edit'])->name('edit');
    Route::put('/{post}',[UserPostController::class, 'update'])->name('update');
    Route::get('/{post}',[UserPostController::class,'show'])->name('show');
    Route::delete('/{post}',[UserPostController::class,'destroy'])->name('destroy');
});