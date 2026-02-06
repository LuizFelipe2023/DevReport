<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Portal') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --admin-bg: #f8f9fc88;

            --card-bg: #ffffff;
            --nav-bg: #ffffff;

            --primary-color: #6366f1;
            --primary-hover: #4f46e5;

            --text-main: #1e293b;
            --text-muted: #64748b;

            --success-soft: #ecfdf5;
            --success-text: #059669;
            --danger-soft: #fef2f2;
            --danger-text: #dc2626;
        }

        body {
            background-color: var(--admin-bg) !important;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: var(--text-main);
        }

        .navbar {
            background-color: var(--nav-bg) !important;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.8rem 0;
        }

        .navbar-brand {
            font-weight: 800;
            color: var(--primary-color) !important;
            letter-spacing: -0.025em;
        }

       
        .card {
            border-radius: 12px !important;
            border: 1px solid #e2e8f0 !important;
            background-color: var(--card-bg);
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1) !important;
        }

       
        .card-header {
            background-color: transparent !important;
            border-bottom: 1px solid #f1f5f9 !important;
            padding: 1.25rem !important;
            font-weight: 700;
            color: var(--text-main);
        }

        
        .btn-primary {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.2);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover) !important;
            transform: translateY(-1px);
        }

       
        .form-label {
            color: var(--text-muted);
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .form-control {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            color: var(--text-main);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .badge.bg-primary {
            background-color: #e0e7ff !important;
            color: var(--primary-color) !important;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <i class="bi bi-layers-half text-primary me-2"></i>
                    {{ config('app.name', 'AdminSaaS') }}
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto align-items-center">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link fw-medium" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle fw-bold text-dark" href="#"
                                    role="button" data-bs-toggle="dropdown">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D6EFD&color=fff"
                                        class="rounded-circle me-1" width="28" alt="avatar">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3">
                                    <a class="dropdown-item py-2" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i> {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>