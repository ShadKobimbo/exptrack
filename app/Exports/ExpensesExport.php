<?php

namespace App\Exports;

use App\Models\Expense;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class ExpensesExport implements FromView
{
    public function view(): View
    {
        return view('exports.expenses', [
            'expenses' => Expense::with('shop')
                ->where('user_id', Auth::id())
                ->latest()
                ->get()
        ]);
    }
}

