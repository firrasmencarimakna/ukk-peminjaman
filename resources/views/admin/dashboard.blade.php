@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <h2 class="text-2xl font-bold mb-4">Admin Dashboard</h2>
        <p>Welcome, {{ Auth::user()->name }}!</p>
        
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
            <div class="border border-gray-200 border-l-4 border-l-blue-400 bg-blue-50/30 p-4 rounded-md hover:bg-blue-50 transition-colors shadow-sm">
                <h3 class="font-bold text-gray-800">Users</h3>
                <p class="text-gray-500 mb-3 text-xs">Manage system accounts.</p>
                <a href="{{ route('admin.users.index') }}" class="font-bold text-blue-600 hover:underline">Enter &rarr;</a>
            </div>
            <div class="border border-gray-200 border-l-4 border-l-blue-400 bg-blue-50/30 p-4 rounded-md hover:bg-blue-50 transition-colors shadow-sm">
                <h3 class="font-bold text-gray-800">Tools</h3>
                <p class="text-gray-500 mb-3 text-xs">Inventory & categories.</p>
                <div class="flex gap-4">
                    <a href="{{ route('admin.tools.index') }}" class="font-bold text-blue-600 hover:underline">Tools</a>
                    <a href="{{ route('admin.categories.index') }}" class="font-bold text-blue-600 hover:underline">Categories</a>
                </div>
            </div>
            <div class="border border-gray-200 border-l-4 border-l-blue-400 bg-blue-50/30 p-4 rounded-md hover:bg-blue-50 transition-colors shadow-sm">
                <h3 class="font-bold text-gray-800">Loans</h3>
                <p class="text-gray-500 mb-3 text-xs">Approval & returns.</p>
                 <a href="{{ route('admin.loans.index') }}" class="font-bold text-blue-600 hover:underline">View All &rarr;</a>
            </div>
            <div class="border border-gray-200 border-l-4 border-l-blue-400 bg-blue-50/30 p-4 rounded-md hover:bg-blue-50 transition-colors shadow-sm">
                <h3 class="font-bold text-gray-800">Logs</h3>
                <p class="text-gray-500 mb-3 text-xs">System history.</p>
                 <a href="{{ route('admin.logs.index') }}" class="font-bold text-blue-600 hover:underline">Open &rarr;</a>
            </div>
        </div>
    </div>
</div>
@endsection
