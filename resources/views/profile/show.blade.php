@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Profile</h2>

    {{-- Profile Information --}}
    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
        <div class="card mb-4">
            <div class="card-header">Update Profile Information</div>
            <div class="card-body">
                {{-- Replace with real form --}}
                <form method="POST" action="#">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ auth()->user()->email }}">
                    </div>
                    <button class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    @endif

    {{-- Update Password --}}
    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        <div class="card mb-4">
            <div class="card-header">Update Password</div>
            <div class="card-body">
                {{-- Replace with real password update form --}}
                <form method="POST" action="#">
                    @csrf
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                    <button class="btn btn-primary">Update Password</button>
                </form>
            </div>
        </div>
    @endif

    {{-- Two-Factor Authentication --}}
    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
        <div class="card mb-4">
            <div class="card-header">Two-Factor Authentication</div>
            <div class="card-body">
                <p>This section should include enabling/disabling 2FA.</p>
                {{-- You can use Livewire or custom logic here --}}
            </div>
        </div>
    @endif

    {{-- Logout Other Browser Sessions --}}
    <div class="card mb-4">
        <div class="card-header">Logout Other Browser Sessions</div>
        <div class="card-body">
            <form method="POST" action="#">
                @csrf
                <p>You may logout from all other browser sessions.</p>
                <div class="mb-3">
                    <label for="password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button class="btn btn-danger">Logout Other Sessions</button>
            </form>
        </div>
    </div>

    {{-- Delete Account --}}
    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
        <div class="card mb-4">
            <div class="card-header text-danger">Delete Account</div>
            <div class="card-body">
                <form method="POST" action="#">
                    @csrf
                    @method('DELETE')
                    <p class="text-danger">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                    <div class="mb-3">
                        <label for="password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button class="btn btn-danger">Delete Account</button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection
