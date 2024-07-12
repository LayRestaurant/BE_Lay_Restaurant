<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shoppingCarts = ShoppingCart::where('user_id', $request->user_id)->with('food')->get();
        return response()->json($shoppingCarts);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'food_id' => 'required', // Kiểm tra rằng food_id tồn tại trong bảng food
            'quantity' => 'required|integer|min:1',
        ]);
        $food_price = DB::table('food')->where('id', $request->food_id)->value('price');
        $existingCartItem = DB::table('shopping_cart')
            ->where('food_id', $request->food_id)
            ->where('user_id', $request->user_id)
            ->value('food_id');
        if ($existingCartItem) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, báo lỗi hoặc thực hiện hành động phù hợp
            return response()->json(['error' => 'Sản phẩm đã tồn tại trong giỏ hàng của bạn.'], 400);
        }
        $shoppingCart = ShoppingCart::create([
            'user_id' => $request->user_id,
            'food_id' => $request->food_id,
            'quantity' => $request->quantity,
            'total_price' => $food_price * $request->quantity,
        ]);
        return response()->json($shoppingCart, 201);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $food_id)
    {
        // Tìm giỏ hàng của user có user_id tương ứng và food_id cần xóa
        $shoppingCart = ShoppingCart::where('user_id', $request->user_id)
            ->where('food_id', $food_id)
            ->firstOrFail();
        // Xóa đối tượng giỏ hàng
        $shoppingCart->delete();
        // Trả về mã trạng thái 204 (No Content)
        return response()->json(null, 204);
    }
    public function setQuantityOrder(Request $request)
    {
        // Validate the request data
        $request->validate([
            'food_id' => 'required|integer|exists:food,id', // assuming food table
            'quantity' => 'required|integer|min:1'
        ]);
        // Find the shopping cart item
        $cartItem = ShoppingCart::where('user_id', $request->user_id)
            ->where('food_id', $request->food_id)
            ->first();
        if ($cartItem) {
            $food_price = DB::table('food')->where('id', $request->food_id)->value('price');
            // Update the quantity of the existing item
            $cartItem->quantity = $request->quantity;
            $cartItem->total_price = $request->quantity * $food_price;
            $cartItem->save();
            return response()->json([
                'message' => 'Quantity updated successfully',
                'cartItem' => $cartItem
            ], 201); // Use 201 for Created response
        } else {
            return response()->json([
                'message' => 'Item not found in the cart'
            ], 404);
        }
    }
}
