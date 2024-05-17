<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//----------------event messages----------------------------------------
Route::post('/eventMessage/{chat}', [App\Http\Controllers\MessageEventController::class, 'create']);

//----------------test--------------------------------------------------
Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});