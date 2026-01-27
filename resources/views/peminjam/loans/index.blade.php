@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold">My Loans</h2>
            <a href="{{ route('peminjam.dashboard') }}" class="text-gray-500 hover:text-gray-800 flex items-center gap-1 text-sm">
                &larr; Back to Dashboard
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tool</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Borrow Date</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Expected Return</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fine</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loans as $loan)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $loan->tool->name }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $loan->borrow_date }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $loan->expected_return_date }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-xs">
                            <span class="px-2 inline-flex text-[10px] leading-4 font-bold border border-gray-300 rounded tracking-tighter
                                {{ $loan->status === 'approved' ? 'text-green-600 border-green-200' : 
                                   ($loan->status === 'returning' ? 'text-purple-600 border-purple-200' : 
                                   ($loan->status === 'returned' ? 'text-blue-600 border-blue-200' : 
                                   ($loan->status === 'rejected' ? 'text-red-600 border-red-200' : 'text-gray-500 border-gray-200'))) }}">
                                {{ ucfirst($loan->status) }}
                            </span>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-xs">
                            @if($loan->fine > 0)
                                <span class="text-red-600 font-bold">Rp {{ number_format($loan->fine) }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-xs">
                            @if($loan->status === 'approved')
                                <form action="{{ route('peminjam.loans.return-request', $loan->id) }}" method="POST" onsubmit="return confirm('Hand over tool?');">
                                    @csrf
                                    <button class="border border-gray-800 text-gray-800 font-bold py-1 px-3 rounded-sm hover:bg-gray-800 hover:text-white transition-colors text-[10px]">
                                        Return
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-300">-</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
