<?php
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

// Lấy tất cả phòng với phân trang
Route::get('/rooms', [RoomController::class, 'index']);

// Lọc phòng theo giá và loại phòng
Route::get('/rooms/filter', [RoomController::class, 'filter']);

// Tìm kiếm phòng theo tên, trạng thái, mô tả
Route::get('/rooms/search', [RoomController::class, 'search']);

// Lấy chi tiết phòng
Route::get('/rooms/{id}', [RoomController::class, 'show']);
