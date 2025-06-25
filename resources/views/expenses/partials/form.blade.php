<div class="mb-3">
    <label for="name" class="form-label">Expense Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $expense->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" class="form-control" required>{{ old('description', $expense->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="shop_id" class="form-label">Shop</label>
    <select name="shop_id" class="form-control" required>
        <option value="">-- Select Shop --</option>
        @foreach ($shops as $shop)
            <option value="{{ $shop->id }}" {{ old('shop_id', $expense->shop_id ?? '') == $shop->id ? 'selected' : '' }}>
                {{ $shop->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="account_debited" class="form-label">Account Debited</label>
    <input type="number" name="account_debited" class="form-control" value="{{ old('account_debited', $expense->account_debited ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="supplier_paid" class="form-label">Supplier Paid</label>
    <input type="text" name="supplier_paid" class="form-control" value="{{ old('supplier_paid', $expense->supplier_paid ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="supplier_contact" class="form-label">Supplier Contact</label>
    <input type="number" name="supplier_contact" class="form-control" value="{{ old('supplier_contact', $expense->supplier_contact ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="amount" class="form-label">Amount</label>
    <input type="number" name="amount" class="form-control" value="{{ old('amount', $expense->amount ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="transaction_number" class="form-label">Transaction Number</label>
    <input type="number" name="transaction_number" class="form-control" value="{{ old('transaction_number', $expense->transaction_number ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="evidence_file" class="form-label">Upload Evidence</label>
    <input type="file" name="evidence_file" class="form-control" {{ isset($expense) ? '' : 'required' }}>
</div>

@if (isset($expense) && $expense->evidence_path)
    <div class="mb-3">
        <a href="{{ asset('storage/' . $expense->evidence_path) }}" target="_blank">View Current File</a>
    </div>
@endif

