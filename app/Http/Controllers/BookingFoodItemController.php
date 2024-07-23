<?php
namespace App\Http\Controllers;

use App\Models\BookingFoodItem;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingFoodItemController extends Controller
{
    // List all booking food items
    public function index()
    {
        $items = BookingFoodItem::with('food')->get();
        return response()->json($items, Response::HTTP_OK);
    }

    // Show a specific booking food item
    public function show($id)
    {
        $item = BookingFoodItem::with('food')->findOrFail($id);
        return response()->json($item, Response::HTTP_OK);
    }

    // Create a new booking food item
    public function store(Request $request)
    {
        $data = $request->validate([
            'booking_id' => 'required|exists:booking_food,id',
            'food_id' => 'required|exists:food,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric',
        ]);

        $data['total_price'] = $data['quantity'] * $data['price'];

        $item = BookingFoodItem::create($data);

        return response()->json($item, Response::HTTP_CREATED);
    }

    // Update an existing booking food item
    public function update(Request $request, $id)
    {
        $item = BookingFoodItem::findOrFail($id);

        $data = $request->validate([
            'food_id' => 'exists:food,id',
            'quantity' => 'integer|min:1',
            'price' => 'numeric',
        ]);

        $data['total_price'] = $data['quantity'] * $data['price'];

        $item->update($data);

        return response()->json($item, Response::HTTP_OK);
    }

    // Delete a booking food item
    public function destroy($id)
    {
        $item = BookingFoodItem::findOrFail($id);
        $item->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
