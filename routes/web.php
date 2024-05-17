<?php

use App\Events\MessageNotification;
use App\Events\MessageSent;
use App\Mail\NewUserWelcomeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

//----------------temporary-mails-------------------------------
Route::get('email', function(){
    return new NewUserWelcomeMail; //just to see how the user will see the mail
});

//----------------follow----------------------------------------
Route::post('follow/{user}', [App\Http\Controllers\FollowsController::class, 'store'])->name('profile.show');

//----------------profile----------------------------------------
Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');

//----------------posts----------------------------------------
Route::get('/', [App\Http\Controllers\PostsController::class, 'index']);
Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'create'])->name('posts.create'); //this line has to be on top of {post} because in the other way would generate a conflict
Route::get('/p/{post}', [App\Http\Controllers\PostsController::class, 'show'])->name('posts.show');
Route::post('/p', [App\Http\Controllers\PostsController::class, 'store'])->name('posts.create');

//----------------comments----------------------------------------

Route::post('/comments/create/{post}', [App\Http\Controllers\CommentsController::class, 'create'])->name('comments.create');

//----------------likes----------------------------------------

Route::post('/like/{post}', [App\Http\Controllers\LikesController::class, 'store']);

//----------------chats----------------------------------------
Route::get('/inbox', [App\Http\Controllers\Chats\ChatsController::class, 'show']);
Route::get('/chats/{chat}', [App\Http\Controllers\Chats\ChatsController::class, 'create']);

//----------------messages----------------------------------------
Route::get('/messages/{chat}', [App\Http\Controllers\Messages\MessagesController::class, 'show']);
/* Route::post('/messages/{chat}', [App\Http\Controllers\Messages\MessagesController::class, 'create']); */

/* Route::get('/event', function(){
    event(new MessageSent('im in the event'));
}); */