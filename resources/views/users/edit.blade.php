@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit User</h2>

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        @include('users.partials.form', ['user' => $user])
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
