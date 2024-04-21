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


     public function store(LoginRequest $request)
     {
         $request->authenticate();
         $request->session()->regenerate();

         $email = $request->email;
         $user = User::where('email', $email)->first(); // Assuming email is unique

         return response()->json([
            'user' => $user,
            'message' => 'Login successful'
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
