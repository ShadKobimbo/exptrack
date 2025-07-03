@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Add New Expense</h2>

    <form action="{{ route('expenses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('expenses.partials.form', ['expense' => null])

        <button type="submit" class="btn btn-primary mt-3">Save Expense</button>
        <button type="submit" name="action" value="draft" class="btn btn-secondary mt-3">Save as Draft</button>
    </form>
</div>
@endsection
