<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalAllTime = Expense::where('user_id', $userId)->sum('amount');

        $totalThisMonth = Expense::where('user_id', $userId)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        $totalToday = Expense::where('user_id', $userId)
            ->whereDate('created_at', Carbon::today())
            ->sum('amount');

        return view('dashboard', compact('totalAllTime', 'totalThisMonth', 'totalToday'));
    }
}

