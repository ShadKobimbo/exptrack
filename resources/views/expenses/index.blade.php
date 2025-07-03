@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Your Expenses</h2>

    <div class="mb-3 d-flex gap-2">
        <a href="{{ route('expenses.create') }}" class="btn btn-primary"><i class="bi bi-plus-square"></i> New Expense</a>
        <a href="{{ route('expenses.export') }}" class="btn btn-success"><i class="bi bi-file-spreadsheet"></i> Export Excel</a>

        <!-- Trigger Search Modal -->
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#searchModal">
            <i class="bi bi-search"></i>
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($expenses->isEmpty())
        <div class="alert alert-info">No expenses found.</div>
    @else
        {{-- <div class="mb-3 d-flex gap-2 float-right">
            <a href="{{ route('expenses.index', ['status' => 'draft']) }}" class="btn btn-outline-secondary btn-sm">Drafts</a>
            <a href="{{ route('expenses.index', ['status' => 'submitted']) }}" class="btn btn-outline-success btn-sm">Submitted</a>
            <a href="{{ route('expenses.index') }}" class="btn btn-outline-primary btn-sm">All</a>
        </div> --}}
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th class="d-none d-md-table-cell">Location</th>
                    <th class="d-none d-lg-table-cell">Transaction #</th>
                    <th class="d-none d-lg-table-cell">Supplier</th>
                    <th class="d-none d-xl-table-cell">Supplier Contact</th>
                    <th class="d-none d-xl-table-cell">Date</th>
                    <th class="d-none d-xl-table-cell">Evidence</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($expenses as $expense)
                    <tr>
                        <td>{{ $expense->name }}</td>
                        <td>{{ number_format($expense->amount) }}</td>
                        <td class="d-none d-md-table-cell">{{ $expense->shop->name ?? 'N/A' }}</td>
                        <td class="d-none d-lg-table-cell">{{ $expense->transaction_number }}</td>
                        <td class="d-none d-lg-table-cell">{{ $expense->supplier_paid }}</td>
                        <td class="d-none d-xl-table-cell">{{ $expense->supplier_contact }}</td>
                        <td class="d-none d-xl-table-cell">{{ $expense->created_at->format('M j, Y') }}</td>
                        <td class="d-none d-xl-table-cell">
                            @if ($expense->evidence_path)
                                <a href="{{ asset('storage/' . $expense->evidence_path) }}" target="_blank">View</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @include('expenses.partials.action_buttons', ['expense' => $expense])
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

<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="GET" action="{{ route('expenses.index') }}" class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="searchModalLabel">Search Expenses</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Name or Supplier..." value="{{ request('search') }}">
                </div>
                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
            </div>
            <div class="modal-footer">
            <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Reset</a>
            <button type="submit" class="btn btn-primary">Apply Filters</button>
            </div>
        </form>
    </div>
</div>

<!-- AJAX Display Modal -->
<div class="modal fade" id="expenseModal" tabindex="-1" aria-labelledby="expenseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">Expense Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="expenseModalBody">
                <div class="text-center text-muted">Loading...</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function loadExpenseDetails(id) {
        var modal = new bootstrap.Modal(document.getElementById('expenseModal'));
        $('#expenseModalBody').html('<div class="text-center text-muted">Loading...</div>');
    
        $.ajax({
            url: '/expenses/' + id + '/ajax',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#expenseModalBody').html(data.html);
                modal.show();
            },
            error: function() {
                $('#expenseModalBody').html('<div class="text-danger">Error loading details.</div>');
            }
        });
    }
</script>
    
  
@endsection
