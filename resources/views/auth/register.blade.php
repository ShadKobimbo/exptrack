@extends('layouts.app')

@section('content')
<div class="container-fluid d-flex align-items-center justify-content-center">
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
            <h4 class="fw-bold">Sign Up</h4>
            <p class="text-muted mb-4">Fill in your details below</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    <small class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.</small>
                     @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Repeat Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-semibold">Repeat Password</label>
                    <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Terms -->
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" value="1" id="terms" required>
                    <label class="form-check-label" for="terms">
                        I accept the <a href="#" class="text-decoration-none text-primary">Term</a>
                    </label>
                </div>

                <!-- Submit -->
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">Sign Up</button>
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

                <div class="text-center">
                    Already have an account? <a href="{{ route('login') }}" class="text-decoration-none text-primary">Sign In</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
