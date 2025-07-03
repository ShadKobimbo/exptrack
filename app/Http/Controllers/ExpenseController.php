<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\ExpensesExport;
use Maatwebsite\Excel\Facades\Excel;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $query = Expense::with('shop')->where('user_id', Auth::id());

        $status = $request->input('status');

        // $query = Expense::with('shop')->when($status, function ($query, $status) {
        //     return $query->where('status', $status);
        // });

        $query = Expense::with('shop');

        // Search filter
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('supplier_paid', 'like', "%$search%")
                ->orWhere('transaction_number', 'like', "%$search%");
            });
        }

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('expense_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('expense_date', '<=', $request->end_date);
        }


        // Paginate the result (10 per page)
        $expenses = $query->orderByDesc('expense_date')->paginate(10)->appends($request->query());

        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $shops = Shop::all();
        return view('expenses.create', compact('shops'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'shop_id' => 'required|exists:shops,id',
            'supplier_paid' => 'nullable|string|max:255',
            'supplier_contact' => 'nullable|integer',
            'amount' => 'required|integer',
            'transaction_charge' => 'nullable|integer',
            'transaction_number' => 'nullable|string',
            'expense_date' => 'nullable|date',
            'evidence_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ],[
            'name.required' => 'The expense name is required.',
            'amount.required' => 'You must enter an amount.',
            'amount.numeric' => 'The amount must be a number.',
        ]);

        if ($request->hasFile('evidence_file')) {
            $path = $request->file('evidence_file')->store('evidence', 'public');
        } else {
            $path = '';
        }

        $status = $request->input('action') === 'draft' ? 'draft' : 'submitted';

        Expense::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'shop_id' => $request->shop_id,
            'account_debited' => $request->account_debited,
            'supplier_paid' => $request->supplier_paid,
            'supplier_contact' => $request->supplier_contact,
            'amount' => $request->amount,
            'transaction_charge' => $request->transaction_charge,
            'transaction_number' => $request->transaction_number,
            'expense_date' => $request->expense_date,
            'evidence_path' => $path,
            'status' => $status,
        ]);

        return redirect()->route('expenses.index')->with('success', $status === 'draft' ? 'Draft saved successfully.' : 'Expense submitted successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        // $this->authorize('update', $expense);
        $shops = Shop::all();
        return view('expenses.edit', compact('expense', 'shops'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        // $this->authorize('update', $expense);

        if ($request->hasFile('evidence_file')) {
            $path = $request->file('evidence_file')->store('evidence', 'public');
            $expense->evidence_path = $path;
        }

        $expense->update($request->only([
            'name', 'description', 'shop_id', 'account_debited',
            'supplier_paid', 'supplier_contact', 'amount', 'transaction_charge', 'transaction_number', 'expense_date', 'status'
        ]) + ['evidence_path' => $expense->evidence_path]);

        return redirect()->route('expenses.index')->with('success', 'Expense updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        // $this->authorize('delete', $expense);
        if($expense->delete()){
            return redirect()->route('expenses.index')->with('success', 'Expense deleted.');
        }
    }

    public function export()
    {
        return Excel::download(new ExpensesExport, 'expenses.xlsx');
    }

    public function ajaxShow(Expense $expense){
        return response()->json([
            'html' => view('expenses.partials.ajax_details', compact('expense'))->render(),
        ]);
    }

}
