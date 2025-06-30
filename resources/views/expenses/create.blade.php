@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Add New Expense</h2>

    <form action="{{ route('expenses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('expenses.partials.form', ['expense' => null])

        <button type="submit" class="btn btn-primary mt-3">Save Expense</button>
    </form>
</div>
@endsection
