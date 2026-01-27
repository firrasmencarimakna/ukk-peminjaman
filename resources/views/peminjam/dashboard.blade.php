@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <h2 class="text-2xl font-bold mb-4">Peminjam Dashboard</h2>
        <p>Welcome, {{ Auth::user()->name }}!</p>
        
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
            <div class="border border-gray-200 border-l-4 border-l-emerald-400 bg-emerald-50/20 p-6 rounded-md hover:bg-emerald-50 transition-colors shadow-sm">
                <h3 class="font-bold text-gray-900 mb-1 tracking-wider">Borrow Tools</h3>
                <p class="text-gray-500 mb-4 text-xs">Browse catalog and start a request.</p>
                <a href="{{ route('peminjam.tools.index') }}" class="font-bold text-emerald-600 hover:underline">
                    Catalog &rarr;
                </a>
            </div>

            <div class="border border-gray-200 border-l-4 border-l-emerald-400 bg-emerald-50/20 p-6 rounded-md hover:bg-emerald-50 transition-colors shadow-sm">
                <h3 class="font-bold text-gray-900 mb-1 tracking-wider">My Loans</h3>
                <p class="text-gray-500 mb-4 text-xs">Check status and return tools.</p>
                <a href="{{ route('peminjam.loans.index') }}" class="font-bold text-emerald-600 hover:underline">
                    History &rarr;
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
