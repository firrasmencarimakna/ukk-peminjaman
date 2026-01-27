@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold">Tool Catalog</h2>
            <a href="{{ route('peminjam.dashboard') }}" class="text-gray-500 hover:text-gray-800 flex items-center gap-1 text-sm">
                &larr; Back to Dashboard
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($tools as $tool)
            <div class="border rounded-lg p-4 hover:shadow-lg transition">
                <h3 class="font-bold text-xl mb-2">{{ $tool->name }}</h3>
                <p class="text-gray-600 mb-2">{{ $tool->description }}</p>
                <p class="text-sm text-gray-500 mb-4">Stock: {{ $tool->stock }}</p>
                
                <form action="{{ route('peminjam.loans.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tool_id" value="{{ $tool->id }}">
                    
                    <div class="mb-2">
                        <label class="block text-xs font-bold mb-1">Borrow Date</label>
                        <input type="date" name="borrow_date" class="w-full border rounded px-2 py-1" required>
                    </div>
                     <div class="mb-4">
                        <label class="block text-xs font-bold mb-1">Duration (Days)</label>
                        <input type="number" name="duration" min="1" max="14" value="1" class="w-full border rounded px-2 py-1" required>
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-600 text-white rounded py-2 hover:bg-blue-700">
                        Borrow Request
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
