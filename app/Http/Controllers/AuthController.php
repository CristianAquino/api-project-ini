<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(
                ['error' => 'Invalid credentials'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        $cookie = cookie('api_token', $token, 60 * 24);

        return response()->json([
            'token' => $token,
            'user' => Auth::user(),
        ])->cookie($cookie);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create($request->all());
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function logout()
    {
        Auth::logout();
        $cookie = Cookie::forget('api_token');
        return response()->json(['message' => 'Successfully logged out'])->cookie($cookie);
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh(true, true));
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
