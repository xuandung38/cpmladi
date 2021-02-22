<?php

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

Route::get('/contact', function () {
	return view('contact');
});

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/blogs.html', [\App\Http\Controllers\Frontend\BlogController::class, 'index'])->name('blog');

Route::get('/blogs/{post}.html', [\App\Http\Controllers\Frontend\BlogController::class, 'post'])->name('post.detail');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
	//template
	Route::get('', [\App\Http\Controllers\BackEnd\LadiController::class, 'index'])->name('ladi.index');
	Route::patch('', [\App\Http\Controllers\BackEnd\LadiController::class, 'update'])->name('ladi.update');
	Route::get('/reset', [\App\Http\Controllers\BackEnd\LadiController::class, 'reset'])->name('ladi.reset');

	//blog
	Route::resource('blogCategory', \App\Http\Controllers\BackEnd\BlogController::class);
	Route::resource('post', \App\Http\Controllers\BackEnd\PostController::class);
	Route::resource('user', \App\Http\Controllers\BackEnd\UserController::class);
	Route::get('contact', [\App\Http\Controllers\BackEnd\ContactController::class, 'index'])->name('contact.index');
});

