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
        $expenses = Expense::where("user_id", $userId)->get();

        if (!auth()->user()->isAdmin()) {

            $totalAllTime = Expense::where('user_id', auth()->id())->sum('amount');

            $totalThisMonth = Expense::where('user_id', auth()->id())
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('amount');
    
            $totalToday = Expense::where('user_id', auth()->id())
                ->whereDate('created_at', Carbon::today())
                ->sum('amount');
        } else{
            $totalAllTime = Expense::sum('amount');

            $totalThisMonth = Expense::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('amount');
    
            $totalToday = Expense::whereDate('created_at', Carbon::today())
                ->sum('amount');
        }

        return view('dashboard', compact('totalAllTime', 'totalThisMonth', 'totalToday'));
    }
}

