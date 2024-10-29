<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // Lấy tất cả phòng với phân trang
    public function index()
    {
        $rooms = Room::paginate(15);
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

        // Apply filters based on available fields
        if ($request->input('name')) {
            $query->where('name', 'like', "%{$request->name}%");
        }
        if ($request->input('price')) {
            $query->where('price', 'like', "%{$request->price}%");
        }
        if ($request->input('capacity')) {
            $query->where('capacity', 'like', "%{$request->capacity}%");
        }
        if ($request->input('room_type')) {
            $query->where('room_type', "{$request->room_type}");
        }

        // Execute the query and get the results
        $rooms = $query->get();

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
    public function changeStatusRoom($id)
    {
        $room = Room::findOrFail($id);
        if ($room->status === 'booked') {
            $room->status = 'active';
        } else if ($room->status === 'active') {
            $room->status = 'booked';
        }
        $room->save();
        return response()->json($room, 200);
    }
}
