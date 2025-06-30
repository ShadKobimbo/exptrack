<div class="sidebar d-flex flex-column p-3 text-white bg-dark">
    
     <!-- Brand/Logo -->
     <a class="navbar-brand" href="{{ route('dashboard') }}">
        <img src="{{ asset('storage/cycloville-logo.png') }}" alt="Logo">
    </a>

    <!-- Brand/Name -->
    <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-3 text-white text-decoration-none">
        {{-- <span class="fs-5 fw-bold">{{ config('app.name', 'Laravel') }}</span> --}}
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li>
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('expenses.index') }}" class="nav-link {{ request()->routeIs('expenses.index') ? 'active' : '' }}">
                Expenses
            </a>
        </li>
        <li>
            <a href="{{ route('shops.index') }}" class="nav-link {{ request()->routeIs('shops.index') ? 'active' : '' }}">
                Shops
            </a>
        </li>
        <li>
            <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
                Users
            </a>
        </li>
    </ul>
    <hr>
    @auth
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
               data-bs-toggle="dropdown" aria-expanded="false">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                         width="32" height="32" class="rounded-circle me-2">
                @endif
                <strong>{{ Auth::user()->name }}</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <li><a class="dropdown-item" href="{{ route('api-tokens.index') }}">API Tokens</a></li>
                @endif
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    @endauth
</div>
