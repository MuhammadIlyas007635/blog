<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});

// route::get('/', [HomeController::class, 'index'])->name('home');

route::get('/', [AdminController::class, 'homepage'])->name('home');
route::get('/home', [AdminController::class, 'index'])->name('home');
route::get('/create_post', [AdminController::class, 'createPost'])->name('create_post');
route::post('/store_post', [AdminController::class, 'storePost'])->name('store_post');
route::get('/get_post', [AdminController::class, 'getPost'])->name('get_post');
route::get('/delete_post/{id}', [AdminController::class, 'deletePost'])->name('delete_post');
route::get('/eidt_post/{id}', [AdminController::class, 'editPost'])->name('eidt_post');
route::post('/update_post/{id}', [AdminController::class, 'updatePost'])->name('update_post');
route::get('/approve_post/{id}', [AdminController::class, 'approvePost'])->name('approve_post');

route::post('/add_comment', [HomeController::class, 'add_comment'])->name('add_comment');
route::get('/get_comment/{postId}', [HomeController::class, 'getcomment'])->name('get_comment');
route::get('/about_user', [HomeController::class, 'about_user'])->name('about_user'); // Adjusted route to match the method
route::post('/add_reply', [HomeController::class, 'addReply'])->name('add_reply'); // Assuming you have a method to get user posts
