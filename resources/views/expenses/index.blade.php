<x-app-layout>
    <div class="container">
        <h2 class="mb-4">Your Expenses</h2>

        <!-- Search Form -->
        <form method="GET" action="{{ route('expenses.index') }}" class="mb-3 d-flex">
            <input type="text" name="search" class="form-control me-2"
                placeholder="Search expenses..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-primary">Search</button>
        </form>

        <a href="{{ route('expenses.create') }}" class="btn btn-primary mb-3">Add New Expense</a>
        <a href="{{ route('expenses.export') }}" class="btn btn-success mb-3">Export to Excel</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($expenses->isEmpty())
            <p>No expenses found.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Shop</th>
                        <th>Amount</th>
                        <th>Transaction #</th>
                        <th>Supplier</th>
                        <th>Evidence</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses as $expense)
                        <tr>
                            <td>{{ $expense->name }}</td>
                            <td>{{ $expense->shop->name ?? 'N/A' }}</td>
                            <td>{{ $expense->amount }}</td>
                            <td>{{ $expense->transaction_number }}</td>
                            <td>{{ $expense->supplier_paid }}</td>
                            <td>
                                @if ($expense->evidence_path)
                                    <a href="{{ asset('storage/' . $expense->evidence_path) }}" target="_blank">View</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('expenses.destroy', $expense) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this expense?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination links -->
            {{ $expenses->appends(request()->query())->links() }}
        @endif
    </div>
</x-app-layout>
