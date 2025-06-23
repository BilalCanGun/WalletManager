<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\MyWallet;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $goalCount = Goal::count();
        $walletCount = MyWallet::count();
        return view('pages.dashboard', compact('userCount', 'goalCount', 'walletCount'));
    }
}