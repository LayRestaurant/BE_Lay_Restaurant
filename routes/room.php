<?php

use App\Http\Controllers\BookingRoomController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

// Room APIs

// Lấy tất cả phòng với phân trang
Route::get('/rooms', [RoomController::class, 'index']);

// Lọc phòng theo giá và loại phòng
Route::get('/rooms/filter', [RoomController::class, 'filter']);

// Tìm kiếm phòng theo tên, trạng thái, mô tả
Route::get('/rooms/search', [RoomController::class, 'search']);

// Lấy chi tiết phòng
Route::get('/rooms/{id}', [RoomController::class, 'show']);

// Thay đổi trạng thái của phòng
Route::patch('/rooms/{id}/change-status', [RoomController::class, 'changeStatusRoom']);


// Booking Room APIs

// Lấy tất cả các booking
Route::get('/bookingRooms', [BookingRoomController::class, 'index']);

// Lấy chi tiết một booking theo ID
Route::get('/bookingRooms/{id}', [BookingRoomController::class, 'show']);

// Tạo mới một booking
Route::post('/bookingRooms', [BookingRoomController::class, 'store']);

// Cập nhật thông tin một booking theo ID
Route::put('/bookingRooms/{id}', [BookingRoomController::class, 'update']);

// Xóa một booking theo ID
Route::delete('/bookingRooms/{id}', [BookingRoomController::class, 'destroy']);

// Lấy tất cả các booking của một phòng cụ thể
Route::get('/bookingRooms/room/{roomId}', [BookingRoomController::class, 'getBookingsByRoomId']);

// Lấy tất cả các booking của một user cụ thể
Route::get('/bookingRooms/user/{userId}', [BookingRoomController::class, 'getBookingsByUserId']);

// Route cho quản lý cài đặt
Route::get('/settings', [SettingController::class, 'index']);
Route::post('/settings', [SettingController::class, 'store']);
Route::get('/settings/{id}', [SettingController::class, 'show']);
Route::put('/settings/{id}', [SettingController::class, 'update']);
Route::delete('/settings/{id}', [SettingController::class, 'destroy']);
