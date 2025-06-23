<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::all();
        $users = User::all();
        return view('pages.goals', compact('goals', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'userid' => 'required|integer',
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

        Goal::create($data);

        return redirect()->route('goals.index')->with('success', 'Hedef Başarıyla Eklendi.');
    }


    public function update(Request $request, $goalid)
    {
        $request->validate([
            'userid' => 'required|integer',
            'goal_name' => 'required|string|max:255',
            'cost' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $goal = Goal::findOrFail($goalid);
        $data = $request->all();

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('goal_images'), $filename);
            $data['image'] = $filename;
        }

        $goal->update($data);

        return redirect()->route('goals.index')->with('success', 'Hedef başarıyla güncellendi');
    }
    public function destroy($goalid)
    {
        $goal = Goal::findOrFail($goalid);
        $goal->delete();

        return redirect()->route('goals.index')->with('success', 'Veri Başarıyla Silindi.');
    }
}
