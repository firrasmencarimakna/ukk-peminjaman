<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Peminjaman Alat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white shadow-lg p-8 border-t-4 border-indigo-700">
        <h2 class="text-2xl font-bold text-center text-slate-800 mb-8">Masuk Aplikasi</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-5">
                <label for="email" class="block text-slate-700 text-sm font-semibold mb-2">Alamat Email</label>
                <input type="email" name="email" id="email"
                    class="border-2 border-slate-300 w-full py-2.5 px-3 text-slate-700 leading-tight focus:outline-none focus:border-indigo-600 @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="text-red-600 text-xs font-medium mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-slate-700 text-sm font-semibold mb-2">Password</label>
                <input type="password" name="password" id="password"
                    class="border-2 border-slate-300 w-full py-2.5 px-3 text-slate-700 leading-tight focus:outline-none focus:border-indigo-600 @error('password') border-red-500 @enderror"
                    required>
                @error('password')
                    <p class="text-red-600 text-xs font-medium mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-indigo-700 hover:bg-indigo-800 text-white font-bold py-3 px-4 w-full transition-colors">
                    Masuk
                </button>
            </div>
        </form>
    </div>
</body>

</html>