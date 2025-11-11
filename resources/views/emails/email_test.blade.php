@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Send Test Email</h5>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('emails.email-test.send') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Recipient Email</label>
                    <input type="email" name="email" id="email" class="form-control" required placeholder="Enter email address">
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea name="message" id="message" rows="4" class="form-control" required placeholder="Write your message here..."></textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-envelope-fill"></i> Send Test Email
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
