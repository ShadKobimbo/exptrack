@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Add New User</h2>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        @include('users.partials.form', ['user' => null])
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
