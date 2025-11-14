@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Your Expenses</h2>

    <div class="mb-3 d-flex justify-content-between align-items-center flex-wrap gap-2">

        <!-- LEFT SIDE: Per Page Selector -->
        <form method="GET" action="{{ route('expenses.index') }}" class="d-flex">

            {{-- Preserve all existing filters --}}
            @foreach(request()->except('per_page', 'page') as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            <div class="col-auto">
                <select name="per_page" class="form-select" onchange="this.form.submit()">
                    @foreach ([50, 100, 200] as $size)
                        <option value="{{ $size }}" {{ request('per_page') == $size ? 'selected' : '' }}>
                            Show {{ $size }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <!-- RIGHT SIDE: Buttons + Filters -->
        <div class="d-flex align-items-center gap-2 flex-wrap">

            <!-- Add Expense -->
            <a href="{{ route('expenses.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-square"></i> New
            </a>

            <!-- Export -->
            <button type="button" class="btn btn-success btn-sm"
                    onclick="document.getElementById('exportSelected').click()">
                <i class="bi bi-file-spreadsheet"></i> Export
            </button>

            <!-- Delete -->
            <button type="button" class="btn btn-danger btn-sm"
                    onclick="document.getElementById('deleteSelected').click()">
                <i class="bi bi-trash"></i> Delete
            </button>

            <!-- Total Expenses -->
            <div class="btn btn-outline-success btn-sm d-flex align-items-center">
                <strong>Total:</strong>&nbsp; {{ number_format($totalExpenses, 2) }}
            </div>

            <!-- User Filter (Admin Only) -->
            @if(auth()->user()->isAdmin('admin'))
                <form method="GET" action="{{ route('expenses.index') }}" class="d-flex">
                    @foreach(request()->except('user_id','page') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach

                    <select name="user_id" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">-- User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            @endif

            <!-- Search Modal Button -->
            <button type="button" class="btn btn-outline-primary btn-sm"
                    data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($expenses->isEmpty())
        <div class="alert alert-info">No expenses found.</div>
    @else

        <form id="multi-action-form" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="POST">
            <input type="hidden" id="action_type" name="action_type" value="">

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>                
                        <th>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="select-all">
                            </div>
                        </th>
                        <th>Name</th>
                        <th class="d-none d-xl-table-cell">Description</th>
                        <th>Amount</th>
                        <th class="d-none d-xl-table-cell">Transaction Charge</th>
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
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="selected_expenses[]" value="{{ $expense->id }}">
                                </div>
                            </td>
                            <td>{{ $expense->name }}</td>
                            <td class="d-none d-xl-table-cell">{{ $expense->description }}</td>
                            <td>{{ number_format($expense->amount) }}</td>
                            <td class="d-none d-xl-table-cell">{{ $expense->transaction_charge }}</td>
                            <td class="d-none d-md-table-cell">{{ $expense->shop->name ?? 'N/A' }}</td>
                            <td class="d-none d-lg-table-cell">{{ $expense->transaction_number }}</td>
                            <td class="d-none d-lg-table-cell">{{ $expense->supplier_paid }}</td>
                            <td class="d-none d-xl-table-cell">{{ $expense->supplier_contact }}</td>
                            <td class="d-none d-xl-table-cell">
                                @if($expense->expense_date)
                                    {{ Carbon\Carbon::parse($expense->expense_date)->format('Y-m-d')}}
                                @endif
                            </td>
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
            <button id="exportSelected" type="submit" class="btn btn-success" onclick="return submitMultiAction('export')" hidden>Export Selected</button>
            <button id="deleteSelected" type="submit" class="btn btn-danger" onclick="return submitMultiAction('delete')" hidden>Delete Selected</button>
        </form>

        <!-- Per Page Selector -->
        <form method="GET" action="{{ route('expenses.index') }}" class="row g-2 mb-3">

            {{-- Preserve all existing filters --}}
            @foreach(request()->except('per_page', 'page') as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            <div class="col-auto">
                <select name="per_page" class="form-select" onchange="this.form.submit()">
                    @foreach ([50, 100, 200] as $size)
                        <option value="{{ $size }}" {{ request('per_page') == $size ? 'selected' : '' }}>
                            Show {{ $size }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <!-- Pagination links -->
        <div class="mt-4">
            {{-- {{ $expenses->appends(request()->query())->links() }} --}}
            {{ $expenses->withQueryString()->links() }}
        </div>
    @endif
</div>

@include('expenses.partials.modals')

<script>
    function loadExpenseDetails(id) {

        $('#modal-loading').removeClass('d-none');
        $('#expenseModalBody').addClass('d-none').html(''); // Clear previous content

        $('#expenseModal').modal('show');

        $.ajax({
            url: '/expenses/' + id + '/ajax',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#expenseModalBody').html(data.html).removeClass('d-none');
                $('#modal-loading').addClass('d-none');
            },
            error: function() {
                $('#expenseModalBody').html('<div class="text-danger">Error loading details.</div>');
            }
        });
    }
</script>

<script>
    function submitMultiAction(action) {
        const form = document.getElementById('multi-action-form');
        const actionTypeInput = document.getElementById('action_type');

        if (action === 'delete') {
            if (!confirm('Are you sure you want to delete the selected expenses?')) {
                return false;
            }
            form.action = "{{ route('expenses.bulkDelete') }}";
            form.method = "POST";
            actionTypeInput.value = 'delete';
            form._method.value = 'DELETE';
        } else if (action === 'export') {
            form.action = "{{ route('expenses.export.selected') }}";
            form.method = "POST";
            actionTypeInput.value = 'export';
            form._method.value = 'POST';
        }

        return true;
    }

    // Select all checkbox logic
    document.getElementById('select-all').addEventListener('change', function () {
        document.querySelectorAll('input[name="selected_expenses[]"]').forEach(cb => cb.checked = this.checked);
    });
</script>
  
@endsection
