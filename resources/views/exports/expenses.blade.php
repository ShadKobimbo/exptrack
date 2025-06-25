<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Shop</th>
            <th>Account Debited</th>
            <th>Supplier</th>
            <th>Supplier Contact</th>
            <th>Amount</th>
            <th>Transaction #</th>
            <th>Uploaded Evidence</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expenses as $expense)
            <tr>
                <td>{{ $expense->name }}</td>
                <td>{{ $expense->description }}</td>
                <td>{{ $expense->shop->name ?? 'N/A' }}</td>
                <td>{{ $expense->account_debited }}</td>
                <td>{{ $expense->supplier_paid }}</td>
                <td>{{ $expense->supplier_contact }}</td>
                <td>{{ $expense->amount }}</td>
                <td>{{ $expense->transaction_number }}</td>
                <td>{{ $expense->evidence_path }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
