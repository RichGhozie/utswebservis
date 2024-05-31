<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller

{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim'     => 'required',
            'password'  => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('nim', 'password');

        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Nim atau Password Anda salah'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'user'    => auth()->guard('api')->user(),
            'token'   => $token
        ], 200);
    }

    public function me()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat menemukan pengguna.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'user' => $user
        ]);
    }

    public function refresh(Request $request)
    {
        // Ambil token lama dari header Authorization
        $oldToken = JWTAuth::getToken();

        try {
            $newToken = JWTAuth::refresh($oldToken);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat merefresh token.'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $newToken
        ]);
    }

    public function logout(Request $request)
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'success' => true,
            'message' => 'Logout Berhasil!',
        ]);
    }
}
