@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Shops</h2>

    <a href="{{ route('shops.create') }}" class="btn btn-primary mb-3">Add Shop</a>

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
                        <a href="{{ route('shops.edit', $shop) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('shops.destroy', $shop) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this shop?')">Delete</button>
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
