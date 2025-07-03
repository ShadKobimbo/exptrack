@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Locations</h2>

    <a href="{{ route('shops.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-square"></i> Add Location</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($shops as $shop)
                <tr>
                    <td>{{ $shop->name }}</td>
                    <td>{{ $shop->location }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('shops.edit', $shop) }}" class="btn btn-sm btn-warning me-1">
                            <i class="bi bi-pencil-square d-inline d-sm-none" data-bs-toggle="tooltip" title="Edit"></i>
                            <span class="d-none d-sm-inline"><i class="bi bi-pencil-square me-1"></i>Edit</span>
                        </a>
                        <!-- Delete Button -->
                        <form action="{{ route('shops.destroy', $shop) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this location?')">
                                <i class="bi bi-trash d-inline d-sm-none" data-bs-toggle="tooltip" title="Delete"></i>
                                <span class="d-none d-sm-inline"><i class="bi bi-trash me-1"></i>Delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3">No shops found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $shops->links() }}
</div>
@endsection
