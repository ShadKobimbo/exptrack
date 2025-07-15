<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SelectedExpensesExport implements FromCollection, WithHeadings, ShouldAutoSize
{

    use Exportable;

    protected $ids;

    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Expense::whereIn('id', $this->ids)->get();

        return Expense::select([
            'name',
            'description',
            'amount',
            'transaction_number',
            'transaction_charge',
            'supplier_paid',
            'supplier_contact',
            'shop_id',
            'account_debited',
            'expense_date'
        ])->whereIn('id', $this->ids)->with('shop', 'user')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Description',
            'Amount',
            'Transaction Number',
            'transaction_charge',
            'Supplier Paid',
            'Supplier Contact',
            'Shop ID',
            'Account Debited',
            'Expense Date'
        ];
    }
}
