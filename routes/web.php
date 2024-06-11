<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\Chats\InboxController;
use App\Http\Controllers\Chats\ChatsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/* Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
}); */

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//----------------user------------------------------------------

Route::middleware('auth')->group(function () {
    Route::get('/user/{user}', [ProfilesController::class, 'index'])->name('profile.index');
});

//----------------profile----------------------------------------

Route::middleware('auth')->group(function () {
    Route::get('/profile/{user}', [ProfilesController::class, 'index'])->name('profile.index');
    Route::get('/profile/{user}/edit', [ProfilesController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/{user}', [ProfilesController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//----------------posts----------------------------------------

Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\PostsController::class, 'index']);
    Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'create'])->name('posts.create'); //this line has to be on top of {post} because in the other way would generate a conflict
    Route::get('/p/{post}', [App\Http\Controllers\PostsController::class, 'show'])->name('posts.show');
    Route::post('/p/create/{user}', [App\Http\Controllers\PostsController::class, 'store'])->name('posts.create');
});

//----------------chats & messages-----------------------------------

Route::get('/inbox', [App\Http\Controllers\Chats\InboxController::class, 'show'])->name('inbox')->middleware("auth");
/* Route::get('/chats/{user}', [App\Http\Controllers\Chats\ChatsController::class, 'create'])->middleware("auth"); */
Route::get('/t/{chat}', [App\Http\Controllers\Chats\ChatsController::class, 'show'])->name('chat')->middleware('auth');

//----------------notifications-----------------------------------

Route::get('/checkChatsNotifications', [App\Http\Controllers\Notifications\MessageNotificationController::class, 'index'])->middleware('auth');

//----------------likes-------------------------------------------

Route::post('/like/{post}', [App\Http\Controllers\LikesController::class, 'store'])->middleware('auth');

//----------------followers---------------------------------------

Route::post('/follow/{user}', [App\Http\Controllers\FollowsController::class, 'store'])->middleware('auth');

//----------------comments---------------------------------------

Route::post('/comment', [App\Http\Controllers\CommentsController::class, 'create'])->middleware('auth');

//----------------------------------------------------------------
require __DIR__.'/auth.php';
