@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Expense</h2>

    <form action="{{ route('expenses.update', $expense) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('expenses.partials.form', ['expense' => $expense])

        <button type="submit" class="btn btn-primary mt-3">Update Expense</button>
    </form>
</div>
@endsection
