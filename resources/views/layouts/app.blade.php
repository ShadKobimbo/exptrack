@php
    use Illuminate\Support\Facades\Route;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Expense Tracker') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Laravel Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .expense-details-card {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }
    
        .expense-details-card dl {
            margin-bottom: 0;
        }
    
        .expense-details-card dt {
            font-weight: 500;
            color: #6c757d;
        }
    
        .expense-details-card dd {
            margin-bottom: 1rem;
            font-weight: 600;
            color: #212529;
        }
    
        .expense-details-card dd:last-child {
            margin-bottom: 0;
        }
    </style>
    
</head>

<body class="font-sans antialiased app-layout">
    <div id="container">

        @auth
            <!-- Sidebar -->
            {{-- @include(view: 'navigation-menu') --}}

            <!-- Navigation -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark  shadow-sm">
                <div class="container">
                    
                    <!-- Brand/Logo -->
                    <a class="navbar-brand fw-bold text-primary" href="#">
                        <img src="{{ asset('storage/cycloville-logo.png') }}" alt="Logo" style="height: 30px;">
                    </a>
                    
                    <!-- Hamburger toggle for mobile -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Navigation Links -->
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        @if (Route::has('login'))
                            <ul class="navbar-nav">
                                @auth
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                            href="{{ route('dashboard') }}">Dashboard</a>
                                    </li>                                    
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('expenses.index') ? 'active' : '' }}"
                                            href="{{ route('expenses.index') }}">Expenses</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('shops.index') ? 'active' : '' }}"
                                            href="{{ route('shops.index') }}">Locations</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}"
                                            href="{{ route('users.index') }}">Users</a>
                                    </li>
                                @else
                                    <li class="nav-item"><a class="nav-link" href="{{ route(name: 'login') }}">Log in</a></li>
                                    <li class="nav-item"><a a class="nav-link text-primary fw-semibold" href="{{ route(name: 'register') }}">Register</a></li>
                                @endauth
                            </ul>
                        @endif
                        <!-- Right side: user dropdown -->
                        @auth
                            <ul class="navbar-nav ms-auto">
                                <!-- Profile photo or username dropdown -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                            <img src="{{ Auth::user()->profile_photo_url }}"
                                                    alt="{{ Auth::user()->name }}"
                                                    class="rounded-circle me-2" width="32" height="32">
                                        @endif
                                        <span>{{ Auth::user()->name }}</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><h6 class="dropdown-header">{{ __('Manage Account') }}</h6></li>
                                        <li><a class="dropdown-item" href="{{ route('profile.show') }}">{{ __('Profile') }}</a></li>
                                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                            <li><a class="dropdown-item" href="{{ route('api-tokens.index') }}">{{ __('API Tokens') }}</a></li>
                                        @endif
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item">{{ __('Log Out') }}</button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        @endauth
                    </div>
                </div>
            </nav>

        @endauth

        <!-- Main Content -->
        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow mb-4">
                <div class="container py-5">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <div class="container py-5">            
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-..." crossorigin="anonymous"></script>
</body>
</html>