<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */


    //  public function store(LoginRequest $request)
    //  {
    //      $request->authenticate();
    //      $request->session()->regenerate();

    //      $user = $request->user(); // Lấy thông tin người dùng đã đăng nhập

    //      return response()->json([
    //          'user' => $user,
    //          'message' => 'Login successful'
    //      ]);
    //  }


    public function store(Request $request)
    {
        // Kiểm tra xác thực đăng nhập
        if (!Auth::attempt($request->only('email', 'password'))) {
            // Nếu thông tin đăng nhập không chính xác, trả về một response lỗi
            return response()->json([
                'message' => 'Thông tin đăng nhập không chính xác.'
            ], 401);
        }
        $email = $request->get('email');
        $user = User::where('email', $email)->first();
        Auth::login($user);
        $roleName = $user->role->name;
        // Trả về response thành công nếu đăng nhập thành công
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Đăng nhập thành công!',
            'role' => $roleName,
            'user' =>  Auth::user()
        ]);
    }




    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
