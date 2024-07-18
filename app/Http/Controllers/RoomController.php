<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // Lấy tất cả phòng với phân trang
    public function index()
    {
        $rooms = Room::paginate(8);
        return response()->json($rooms);
    }

    // Lọc phòng theo giá và loại phòng
    public function filter(Request $request)
    {
        $query = Room::query();

        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->has('room_type')) {
            $query->where('room_type', $request->room_type);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $rooms = $query->paginate(8);
        return response()->json($rooms);
    }

    // Tìm kiếm phòng theo tên, trạng thái, mô tả
    public function search(Request $request)
    {
        $query = Room::query();

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('description', 'like', '%'.$request->search.'%')
                  ->orWhere('status', 'like', '%'.$request->search.'%');
            });
        }

        $rooms = $query->paginate(8);
        return response()->json($rooms);
    }

    // Lấy chi tiết phòng
    public function show($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);
        }

        return response()->json($room);
    }
}
