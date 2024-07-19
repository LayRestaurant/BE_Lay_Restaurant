<?php
namespace App\Http\Controllers;
use App\Models\BookingRoom;
use Illuminate\Http\Request;
class BookingRoomController extends Controller
{
    public function index()
    {
        return response()->json(BookingRoom::all());
    }
    public function show($id)
    {
        return response()->json(BookingRoom::findOrFail($id));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date_format:Y-m-d H:i:s',
            'check_out_date' => 'required|date_format:Y-m-d H:i:s|after:check_in_date',
            'price' => 'required|numeric',
            'number_of_days' => 'required|integer|min:1',
        ]);
        $bookingRoom = BookingRoom::create($request->all());
        return response()->json($bookingRoom, 201);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date_format:Y-m-d H:i:s',
            'check_out_date' => 'required|date_format:Y-m-d H:i:s|after:check_in_date',
            'price' => 'required|numeric',
            'number_of_days' => 'required|integer|min:1',
        ]);
        $bookingRoom = BookingRoom::findOrFail($id);
        $bookingRoom->update($request->all());
        return response()->json($bookingRoom, 200);
    }
    public function destroy($id)
    {
        BookingRoom::destroy($id);
        return response()->json(null, 204);
    }
    public function getBookingsByRoomId($roomId)
    {
        $bookings = BookingRoom::where('room_id', $roomId)->get();
        return response()->json($bookings);
    }
    public function getBookingsByUserId($userId)
    {
        $bookings = BookingRoom::where('user_id', $userId)->get();
        return response()->json($bookings);
    }
}
