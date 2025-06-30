@extends('layouts.app')

@section('content')
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row shadow rounded-4 overflow-hidden w-100">
        <!-- Left Column -->
        <div class="col-md-6 d-none d-md-flex flex-column justify-content-between bg-white p-4">
            <!-- Brand/Logo -->
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('storage/financial-business-round-composition.png') }}" alt="Logo">
            </a>
            <div class="text-center">
                <h3 class="fw-bold">Fast, Efficient and Productive</h3>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed.</p>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <img src="https://flagcdn.com/us.svg" alt="English" width="20">
                    <span>English</span>
                </div>
                <div class="d-flex gap-3">
                    <a href="#" class="text-decoration-none text-primary">Terms</a>
                    <a href="#" class="text-decoration-none text-primary">Plans</a>
                    <a href="#" class="text-decoration-none text-primary">Contact Us</a>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-md-6 bg-light p-5">
            <h4 class="fw-bold">Password Reset</h4>
            <p class="text-muted mb-4">            
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Status Message --}}
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus autocomplete="email">
                </div>

                <!-- Submit -->
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">                    
                        Email Password Reset Link
                    </button>
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mb-3 form-check">
                        <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" name="terms" id="terms" required>
                        <label class="form-check-label" for="terms">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">Terms of Service</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">Privacy Policy</a>',
                            ]) !!}
                        </label>
                        @error('terms')
                            <div class="invalid-feedback d-block">{{ $errors->first('terms') }}</div>
                        @enderror
                    </div>
                @endif
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-decoration-none text-primary">Sign In</a>
                    </div>

                    <div class="text-center">
                        Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none text-primary">Sign Up</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


