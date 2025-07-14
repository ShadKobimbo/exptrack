<!-- View Button (trigger modal) -->
<button type="button"
        class="btn btn-sm btn-info me-1 view-expense-btn"
        data-id="{{ $expense->id }}" onclick="loadExpenseDetails({{ $expense->id }})">
    <i class="bi bi-eye d-inline d-sm-none" data-bs-toggle="tooltip" title="View"></i>
    <span class="d-none d-sm-inline"><i class="bi bi-eye me-1"></i>View</span>
</button>

<!-- Edit Button -->
<a href="{{ route('expenses.edit', $expense) }}" class="btn btn-sm btn-warning me-1">
    <i class="bi bi-pencil-square d-inline d-sm-none" data-bs-toggle="tooltip" title="Edit"></i>
    <span class="d-none d-sm-inline"><i class="bi bi-pencil-square me-1"></i>Edit</span>
</a>

<!-- Delete Button -->
{{-- <form action="{{ route('expenses.destroy', $expense) }}"
    method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger"
            onclick="return confirm('Delete this expense?')">
        <i class="bi bi-trash d-inline d-sm-none" data-bs-toggle="tooltip" title="Delete"></i>
        <span class="d-none d-sm-inline"><i class="bi bi-trash me-1"></i>Delete</span>
    </button>
</form> --}}

<!-- Delete Button -->
{{-- <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" data-expense-id="{{ $expense->id }}">
    <i class="bi bi-trash d-inline d-sm-none" data-bs-toggle="tooltip" title="Delete"></i>
    <span class="d-none d-sm-inline"><i class="bi bi-trash me-1"></i>Delete</span>
</button> --}}