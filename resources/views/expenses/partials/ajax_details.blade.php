<div class="expense-details-card">
    <dl class="row">
        <dt class="col-sm-4">Name</dt>
        <dd class="col-sm-8">{{ $expense->name }}</dd>

        <dt class="col-sm-4">Description</dt>
        <dd class="col-sm-8">{{ $expense->description }}</dd>

        <dt class="col-sm-4"><i class="bi bi-cash"></i> Amount Spent</dt>
        <dd class="col-sm-8 text-success fw-bold">KSh {{ number_format($expense->amount) }}</dd>

        <dt class="col-sm-4"><i class="bi bi-bank"></i> Account Debited</dt>
        <dd class="col-sm-8 text-success fw-bold"> {{ $expense->account_debited }}</dd>

        <dt class="col-sm-4"><i class="bi bi-hash"></i> Transaction Number</dt>
        <dd class="col-sm-8 text-success fw-bold">{{ $expense->transaction_number }}</dd>

        <dt class="col-sm-4"><i class="bi bi-hash"></i> Transaction Charge</dt>
        <dd class="col-sm-8 text-success fw-bold">{{ $expense->transaction_charge }}</dd>

        <dt class="col-sm-4"><i class="bi bi-person"></i> Supplier Paid</dt>
        <dd class="col-sm-8">{{ $expense->supplier_paid }}</dd>

        <dt class="col-sm-4"><i class="bi bi-person-lines-fill"></i> Supplier Contact</dt>
        <dd class="col-sm-8">{{ $expense->supplier_contact }}</dd>

        <dt class="col-sm-4"> <i class="bi bi-geo-alt"></i> Location</dt>
        <dd class="col-sm-8">{{ $expense->shop->name ?? 'N/A' }}</dd>

        <dt class="col-sm-4"> <i class="bi bi-calendar3"></i> Date Of Expense </dt>
        <dd class="col-sm-8">{{ $expense->created_at->format('F j, Y g:i A') }}</dd>

        <dt class="col-sm-4"><i class="bi bi-image"></i> Evidence</dt>
        <dd class="col-sm-8">
            @if ($expense->evidence_path)
                <a href="{{ asset('storage/' . $expense->evidence_path) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                    View Evidence
                </a>
            @else
                <span class="text-muted">
                    No file uploaded
                </span>
            @endif
        </dd>
    </dl>
</div>
