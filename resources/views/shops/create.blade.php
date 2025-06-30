@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Shop</h2>

    <form method="POST" action="{{ route('shops.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Shop Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control @error('location') is-invalid @enderror"
                   value="{{ old('location') }}">
            @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save Shop</button>
    </form>
</div>
@endsection
