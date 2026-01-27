@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold">System Activity Logs</h2>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-800 flex items-center gap-1 text-sm">
                &larr; Back to Dashboard
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Timestamp</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm whitespace-nowrap">
                            {{ $log->created_at }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $log->user->name ?? 'System/Deleted User' }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                {{ $log->action }}
                            </span>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $log->description }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection
