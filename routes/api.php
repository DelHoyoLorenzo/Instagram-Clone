<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//----------------event messages & notification----------------------------------------
Route::post('/eventMessage/{chat}', [App\Http\Controllers\Messages\MessageEventController::class, 'create']);

//---------------- update Messages to seen ----------------------------------------
Route::get('/seen/{chat}', [App\Http\Controllers\Messages\MarkSeenMessages::class, 'update']);

//---------------- notification ----------------------------------------
Route::get('/newMessageNotification', [App\Http\Controllers\Notifications\MessageNotificationController::class, 'index']);

//----------------test--------------------------------------------------
Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});
