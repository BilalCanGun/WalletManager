<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $goals = Goal::with('user')
            ->where('userid', $userId)
            ->get();

        return response()->json(['goals' => $goals], 200);
    }


    public function store(Request $request)
    {
        $request->validate([
            'userid' => 'required|integer|exists:users,userid',
            'goal_name' => 'required|string|max:255',
            'cost' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('goal_images'), $filename);
            $data['image'] = $filename;
        }

        $goal = Goal::create($data);

        return response()->json([
            'message' => 'Hedef başarıyla oluşturuldu.',
            'goal' => $goal
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $goal = Goal::find($id);

        if (!$goal) {
            return response()->json(['message' => 'Hedef bulunamadı.'], 404);
        }

        $request->validate([
            'userid' => 'required|integer|exists:users,userid',
            'goal_name' => 'required|string|max:255',
            'cost' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('goal_images'), $filename);
            $data['image'] = $filename;
        }

        $goal->update($data);

        return response()->json([
            'message' => 'Hedef başarıyla güncellendi.',
            'goal' => $goal
        ], 200);
    }

    public function destroy($id)
    {
        $goal = Goal::find($id);

        if (!$goal) {
            return response()->json(['message' => 'Hedef bulunamadı.'], 404);
        }

        $goal->delete();

        return response()->json(['message' => 'Hedef başarıyla silindi.'], 200);
    }
}
