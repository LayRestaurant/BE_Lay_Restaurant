<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('messages/{userId}', [MessageController::class, 'index']);
Route::get('messages/showRecipientMessage/{userId}', [MessageController::class, 'showRecipientMessage']);
Route::post('messages', [MessageController::class, 'store']);
Route::get('messages/show/{senderId}/{recipientId}', [MessageController::class, 'showSenderMessage']);
Route::patch('messages/{id}/read', [MessageController::class, 'markAsRead']);
