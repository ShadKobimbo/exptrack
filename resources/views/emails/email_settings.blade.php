@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Email Configuration</h5>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('emails.email-settings.update') }}">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mailer</label>
                        <input type="text" name="MAIL_MAILER" value="{{ $settings['MAIL_MAILER'] }}" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Host</label>
                        <input type="text" name="MAIL_HOST" value="{{ $settings['MAIL_HOST'] }}" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Port</label>
                        <input type="number" name="MAIL_PORT" value="{{ $settings['MAIL_PORT'] }}" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Encryption</label>
                        <input type="text" name="MAIL_ENCRYPTION" value="{{ $settings['MAIL_ENCRYPTION'] }}" class="form-control" placeholder="tls or ssl">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="MAIL_USERNAME" value="{{ $settings['MAIL_USERNAME'] }}" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="MAIL_PASSWORD" value="{{ $settings['MAIL_PASSWORD'] }}" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">From Email</label>
                        <input type="email" name="MAIL_FROM_ADDRESS" value="{{ $settings['MAIL_FROM_ADDRESS'] }}" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">From Name</label>
                        <input type="text" name="MAIL_FROM_NAME" value="{{ $settings['MAIL_FROM_NAME'] }}" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Save Settings
                </button>

                <a href="{{ route('emails.email-test') }}" class="btn btn-outline-secondary ms-2">
                    <i class="bi bi-envelope"></i> Send Test Email
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
