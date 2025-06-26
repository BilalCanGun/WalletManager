<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // ✅ REGISTER
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namesurname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'borntime' => 'nullable|date',
            'telno' => 'nullable|string|max:20',
            'job' => 'nullable|string|max:255',
            'saving' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'namesurname' => $request->namesurname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'borntime' => $request->borntime,
            'telno' => $request->telno,
            'job' => $request->job,
            'saving' => $request->saving,
        ]);

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Kayıt başarılı',
            'token' => $token,
            'user' => $user
        ], 201);
    }

    // ✅ LOGIN
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Email veya şifre hatalı'
            ], 401);
        }

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Giriş başarılı',
            'token' => $token,
            'user' => $user
        ], 200);
    }

    // ✅ LOGOUT
    public function logout(Request $request)
    {
        // Kullanıcının sadece şu anki token'ını silmek için:
        $request->user()->currentAccessToken()->delete();

        // Eğer tüm token'larını silmek istersen:
        // $request->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Çıkış başarılı'
        ]);
    }
}
