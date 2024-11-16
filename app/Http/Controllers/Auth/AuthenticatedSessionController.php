<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Traits\HttpsResponse;
use App\Enums\HttpsResponseType;

class AuthenticatedSessionController extends Controller
{
    use HttpsResponse;
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid login credentials'], HttpsResponseType::HTTP_UNAUTHORIZED->value);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success(['user' => $user,'token' => $token], 'User logged in successfully', HttpsResponseType::HTTP_OK->value);
    }

    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success([], 'User logged out successfully', HttpsResponseType::HTTP_OK->value);
    }
}
