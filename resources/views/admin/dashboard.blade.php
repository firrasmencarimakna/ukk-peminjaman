@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-md border-t-4 border-indigo-700">
        <div class="p-6 border-b-2 border-slate-200">
            <h2 class="text-2xl font-bold mb-2 text-slate-800">Dashboard Admin</h2>
           

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
                <div class="border-2 border-indigo-600 border-l-4 bg-white p-4 hover:bg-slate-50 transition-colors">
                    <h3 class="font-bold text-slate-800 mb-1">Pengguna</h3>
                    <p class="text-slate-600 mb-3 text-xs">Kelola akun sistem.</p>
                    <a href="{{ route('admin.users.index') }}"
                        class="font-bold text-indigo-700 hover:text-indigo-900 hover:underline">Masuk &rarr;</a>
                </div>
                <div class="border-2 border-purple-600 border-l-4 bg-white p-4 hover:bg-slate-50 transition-colors">
                    <h3 class="font-bold text-slate-800 mb-1">Alat</h3>
                    <p class="text-slate-600 mb-3 text-xs">Inventori & kategori.</p>
                    <div class="flex gap-4">
                        <a href="{{ route('admin.tools.index') }}"
                            class="font-bold text-purple-700 hover:text-purple-900 hover:underline">Alat</a>
                        <a href="{{ route('admin.categories.index') }}"
                            class="font-bold text-purple-700 hover:text-purple-900 hover:underline">Kategori</a>
                    </div>
                </div>
                <div class="border-2 border-indigo-600 border-l-4 bg-white p-4 hover:bg-slate-50 transition-colors">
                    <h3 class="font-bold text-slate-800 mb-1">Peminjaman</h3>
                    <p class="text-slate-600 mb-3 text-xs">Persetujuan & pengembalian.</p>
                    <a href="{{ route('admin.loans.index') }}"
                        class="font-bold text-indigo-700 hover:text-indigo-900 hover:underline">Lihat Semua &rarr;</a>
                </div>
                <div class="border-2 border-purple-600 border-l-4 bg-white p-4 hover:bg-slate-50 transition-colors">
                    <h3 class="font-bold text-slate-800 mb-1">Log</h3>
                    <p class="text-slate-600 mb-3 text-xs">Riwayat sistem.</p>
                    <a href="{{ route('admin.logs.index') }}"
                        class="font-bold text-purple-700 hover:text-purple-900 hover:underline">Buka &rarr;</a>
                </div>
            </div>
        </div>
    </div>
@endsection