<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>{{ config('app.name', 'SILAPAR') }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    /* warna utama sesuai login/register */
    :root{
      --accent-yellow: #f4a641;
      --accent-dark: #8B0000;
      --accent-dark-2: #a00000;
    }
    /* small utilities */
    .card-shadow { box-shadow: 0 8px 28px rgba(11,15,22,0.06); }
  </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800">
        <div class="flex items-center gap-4">
          @auth
            <div class="hidden sm:flex sm:items-center sm:gap-3">
              <div class="text-sm text-gray-700">Halo, <span class="font-medium">{{ auth()->user()->name }}</span></div>
              <a href="{{ route('menus.index') }}" class="text-sm text-gray-600 hover:text-gray-800">Rekomendasi</a>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="inline">
              @csrf
              <button type="submit"
                      class="flex items-center gap-2 px-4 py-2 rounded-md text-white"
                      style="background: linear-gradient(180deg,var(--accent-dark) 0%, var(--accent-dark-2) 100%);">
                Logout
              </button>
            </form>
          @endauth

  <main class="py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      @yield('content')
    </div>
  </main>

</body>
</html>
