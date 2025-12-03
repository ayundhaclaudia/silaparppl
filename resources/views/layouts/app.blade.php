<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('app.name', 'SILAPAR') }} | SWK Ketintang</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root{
            --primary-color: #A00000;
            --accent-color: #FFC300;
            --accent-dark: #8B0000;
        }

        /* small utilities */
        .card-shadow { box-shadow: 0 8px 30px rgba(11, 15, 22, 0.08); }
        .gradient-btn {
            background: linear-gradient(90deg, var(--primary-color) 0%, var(--accent-dark) 100%);
            transition: all 0.2s ease-in-out;
        }
        .gradient-btn:hover {
            box-shadow: 0 4px 15px rgba(160, 0, 0, 0.4);
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="antialiased bg-gray-100 text-gray-800" style="font-family: 'Poppins', sans-serif;">

    <header class="bg-white card-shadow sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <div class="flex-shrink-0">
                    <a href="/" class="text-2xl font-bold" style="color: var(--primary-color);">
                        SILAPAR <span class="text-gray-500 text-sm font-medium">| SWK</span>
                    </a>
                </div>
                <div class="flex items-center gap-6">
                    @auth
                        <div class="hidden sm:flex sm:items-center sm:gap-6">

                            <a href="{{ route('menus.index') }}"
                               class="text-sm font-semibold text-gray-600 hover:text-primary transition duration-150 ease-in-out"
                               style="color: var(--primary-color);">
                                🍽️ Rekomendasi
                            </a>

                            <div class="text-sm text-gray-700">
                                Halo, <span class="font-semibold" style="color: var(--primary-color);">{{ auth()->user()->name }}</span>
                            </div>
                        </div>

                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                    class="flex items-center gap-2 px-4 py-2 text-sm rounded-lg text-white font-medium gradient-btn shadow-md">
                                Logout
                            </button>
                        </form>
                    @endauth
                </div>
                </div>
        </div>
    </header>

    <main class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    <footer class="mt-20 py-6 text-center text-sm text-gray-500 border-t border-gray-200">
        &copy; 2025 {{ config('app.name', 'SILAPAR') }}. SWK Ketintang.
    </footer>

</body>
</html>
