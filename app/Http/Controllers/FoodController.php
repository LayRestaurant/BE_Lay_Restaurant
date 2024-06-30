<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FoodController extends Controller
{
    public function index()
    {
        $query = Food::orderByDesc('id'); // Mặc định sắp xếp theo tên

        // Lấy số trang từ request (mặc định là trang 1 nếu không có)
        $page = request()->input('page', 1);

        // Sử dụng paginate để lấy dữ liệu của trang hiện tại, mỗi trang có 20 bản ghi
        $foods = $query->paginate(20, ['*'], 'page', $page);

        return response()->json($foods);
    }

    public function filter($price)
    {
        $foods = Food::where('price', '=', $price)->orderBy('price', 'DESC');
        return response()->json($foods->paginate(20));
    }
    public function search(Request $request)
    {
        // Retrieve search parameters from the request
        $name = $request->input('name');
        $price = $request->input('price');
        $type = $request->input('type');

        // Start with the base query
        $foods = Food::query();

        // Add conditions based on the provided parameters
        if ($name) {
            $foods->where('name', 'like', '%' . $name . '%');
        }
        if ($price) {
            $foods->where('price', '=', $price);
        }
        if ($type) {
            $foods->where('type', '=', $type);
        }

        // Paginate and return the results as JSON
        return response()->json($foods->paginate(20));
    }

    public function sortByPrice($type)
    {
        if ($type) {
            $foods = Food::orderBy('price')->paginate(12);
        } else {
            $foods = Food::orderByDesc('price')->paginate(12);
        }

        return response()->json($foods);
    }

    public function adminIndex()
    {
        $foods = Food::orderBy('id', 'desc')->paginate(10);
        return response()->json($foods);
    }

    public function show($id)
    {
        $food = Food::findOrFail($id);
        return response()->json($food);
    }

    public function getForUpdate($id)
    {
        $food = Food::findOrFail($id);
        return response()->json($food);
    }

    public function destroy($id)
    {
        $food = Food::findOrFail($id);
        $food->delete();
        return response()->json(['message' => 'Food deleted successfully']);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'type' => 'required',
            'picture' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $food = Food::create($request->all());
        return response()->json($food, 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'type' => 'required',
            'picture' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $food = Food::findOrFail($id);
        $food->update($request->all());

        return response()->json($food);
    }

    public function getAllPrice()
    {
        $allPrices = Food::orderBy('price', 'desc')->pluck('price');
        return response()->json($allPrices);
    }

    public function getAllType()
    {
        $allPrices = Food::orderBy('type', 'desc')->pluck('type');
        return response()->json($allPrices);
    }

    public function getFoodByType($type)
    {
        $allPrices = Food::where('type', $type)->orderBy('type', 'desc')->paginate(20);
        return response()->json($allPrices);
    }
}
