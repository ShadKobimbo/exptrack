@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Your Expenses</h2>

    <div class="mb-3 d-flex gap-2">
        <a href="{{ route('expenses.create') }}" class="btn btn-primary">Add New Expense</a>
        <a href="{{ route('expenses.export') }}" class="btn btn-success">Export to Excel</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search Form -->
    <form method="GET" action="{{ route('expenses.index') }}" class="mb-3 d-flex">
        <input type="text" name="search" class="form-control me-2"
            placeholder="Search expenses..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-outline-primary">Search</button>
    </form>

    <form method="GET" action="{{ route('expenses.index') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <input type="date" name="start_date" class="form-control"
                   value="{{ request('start_date') }}" placeholder="Start Date">
        </div>
        <div class="col-md-3">
            <input type="date" name="end_date" class="form-control"
                   value="{{ request('end_date') }}" placeholder="End Date">
        </div>
        <div class="col-md-3">
            <input type="text" name="search" class="form-control"
                   placeholder="Search by name or supplier..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3 d-flex">
            <button type="submit" class="btn btn-outline-primary me-2">Filter</button>
            <a href="{{ route('expenses.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>
    

    @if ($expenses->isEmpty())
        <div class="alert alert-info">No expenses found.</div>
    @else
        <div class="mb-3 d-flex gap-2 float-right">
            <a href="{{ route('expenses.index', ['status' => 'draft']) }}" class="btn btn-outline-secondary btn-sm">Drafts</a>
            <a href="{{ route('expenses.index', ['status' => 'submitted']) }}" class="btn btn-outline-success btn-sm">Submitted</a>
            <a href="{{ route('expenses.index') }}" class="btn btn-outline-primary btn-sm">All</a>
        </div>
        <table class="table table-bordered">
            <thead class="table-light">
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
                        <td>KES {{ number_format($expense->amount) }}</td>
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
        <div class="mt-4">
            {{ $expenses->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection
