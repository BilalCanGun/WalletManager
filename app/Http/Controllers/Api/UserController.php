<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me(Request $request)
    {
        $user = $request->user()->load([
            'mywallet',
            'goals',
            // Buraya başka ilişkiler de ekleyebilirsin
        ]);

        return response()->json([
            'user' => $user
        ]);
    }
}
