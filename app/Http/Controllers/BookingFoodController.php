<?php

namespace App\Http\Controllers;

use App\Models\BookingFood;
use Illuminate\Http\Request;

class BookingFoodController extends Controller
{
    public function index()
    {
        $bookings = BookingFood::with('items.food')->get();
        return response()->json($bookings);
    }

    public function show($id)
    {
        $booking = BookingFood::with('items.food')->findOrFail($id);
        return response()->json($booking);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'order_number' => 'required|unique:booking_food,order_number',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'status' => 'required|string',
            'payment_method' => 'required|string',
            'delivery_address' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $booking = BookingFood::create($data);
        return response()->json($booking, 201);
    }

    public function update(Request $request, $id)
    {
        $booking = BookingFood::findOrFail($id);

        $data = $request->validate([
            'user_id' => 'exists:users,id',
            'order_number' => 'unique:booking_food,order_number,' . $booking->id,
            'order_date' => 'date',
            'total_amount' => 'numeric',
            'status' => 'string',
            'payment_method' => 'string',
            'delivery_address' => 'string',
            'note' => 'nullable|string',
        ]);

        $booking->update($data);
        return response()->json($booking);
    }

    public function destroy($id)
    {
        $booking = BookingFood::findOrFail($id);
        $booking->delete();

        return response()->json(null, 204);
    }

    public function getBookingFoodsByUserId($userId)
    {
        $bookings = BookingFood::where('user_id', $userId)->get();
        return response()->json($bookings);
    }
}

