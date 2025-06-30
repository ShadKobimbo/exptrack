<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExpensesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Expense::select([
            'name',
            'description',
            'amount',
            'transaction_number',
            'supplier_paid',
            'supplier_contact',
            'shop_id',
            'account_debited',
            'created_at'
        ])->with('shop', 'user')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Description',
            'Amount',
            'Transaction Number',
            'Supplier Paid',
            'Supplier Contact',
            'Shop ID',
            'Account Debited',
            'Date Created'
        ];
    }

    //public function collection(){
        // return Expense::all();
        //return Expense::with('shop', 'user')->get();
    //}

}


