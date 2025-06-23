<?php

namespace App\Http\Controllers;

use App\Models\MyWallet;
use App\Models\User;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        $wallets = MyWallet::all();
        $users = User::all();
        return view('pages.wallets', compact('wallets', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'userid' => 'required|exists:users,userid',
            'type' => 'required|string',
            'value' => 'required|numeric',
        ]);

        MyWallet::create($request->only('userid', 'type', 'value'));

        return redirect()->route('wallets.index')->with('success', 'Cüzdan kaydı oluşturuldu.');
    }

    public function update(Request $request, $walletid)
    {
        $wallet = MyWallet::findOrFail($walletid);

        $request->validate([
            'userid' => 'required|exists:users,userid',
            'type' => 'required|string',
            'value' => 'required|numeric',
        ]);

        $wallet->update($request->only('userid', 'type', 'value'));

        return redirect()->route('wallets.index')->with('success', 'Cüzdan kaydı güncellendi.');
    }

    public function destroy($walletid)
    {
        $wallet = MyWallet::findOrFail($walletid);
        $wallet->delete();

        return redirect()->route('wallets.index')->with('success', 'Cüzdan kaydı silindi.');
    }
}