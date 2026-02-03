<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 font-sans antialiased">
    <div class="min-h-screen">
        @auth
            <nav class="bg-indigo-700 border-b-2 border-indigo-800 mt-2.5 mx-4" style="border-radius: 50px;">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-14">
                        <div class="flex items-center">
                            <a href="{{ url('/') }}" class="font-bold text-white text-lg tracking-tight">
                                Peminjaman Alat
                            </a>
                        </div>
                        <div class="flex items-center gap-6">
                            <span
                                class="text-xs font-medium text-indigo-100 uppercase tracking-wider">{{ Auth::user()->name }}
                                | {{ Auth::user()->role }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="text-xs font-bold text-indigo-200 hover:text-white transition-colors uppercase tracking-widest">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        @endauth

        <main class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="mb-4 bg-emerald-50 border-l-4 border-emerald-600 text-emerald-800 px-4 py-3" role="alert">
                        <span class="block sm:inline font-medium">{{ session('success') }}</span>
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-4 bg-rose-50 border-l-4 border-rose-600 text-rose-800 px-4 py-3" role="alert">
                        <span class="block sm:inline font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>