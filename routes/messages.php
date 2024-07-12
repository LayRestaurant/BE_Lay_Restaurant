<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('users/messages', [UserController::class, 'getAllUsersAndMessages']);
Route::get('messages/{userId}', [MessageController::class, 'index']);
Route::post('messages', [MessageController::class, 'store']);
Route::get('messages/show/{senderId}/{recipientId}', [MessageController::class, 'showSenderMessage']);
Route::patch('messages/{id}/read', [MessageController::class, 'markAsRead']);

// Thêm route cho phương thức showRecipientMessage
Route::get('messages/showRecipientMessage/{userId}', [MessageController::class, 'showRecipientMessage']);

// Thêm route cho phương thức update
Route::put('messages/{id}', [MessageController::class, 'update']);

// Thêm route cho phương thức delete
Route::delete('messages/{id}', [MessageController::class, 'destroy']);
