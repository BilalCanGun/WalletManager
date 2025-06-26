<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MyWallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        $wallets = MyWallet::with('user')->get(); // İstersen ilişkili user bilgisi de gelebilir
        return response()->json($wallets, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'userid' => 'required|exists:users,userid',
            'type' => 'required|string',
            'value' => 'required|numeric',
        ]);

        $wallet = MyWallet::create($validated);

        return response()->json([
            'message' => 'Cüzdan kaydı oluşturuldu.',
            'wallet' => $wallet
        ], 201);
    }

    public function update(Request $request, $walletid)
    {
        $wallet = MyWallet::findOrFail($walletid);

        $validated = $request->validate([
            'userid' => 'required|exists:users,userid',
            'type' => 'required|string',
            'value' => 'required|numeric',
        ]);

        $wallet->update($validated);

        return response()->json([
            'message' => 'Cüzdan kaydı güncellendi.',
            'wallet' => $wallet
        ], 200);
    }

    public function destroy($walletid)
    {
        $wallet = MyWallet::findOrFail($walletid);
        $wallet->delete();

        return response()->json([
            'message' => 'Cüzdan kaydı silindi.'
        ], 200);
    }
}
