@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold">User Management</h2>
            <div class="flex items-center gap-6">
                 <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 border border-black rounded text-xs font-bold hover:bg-black hover:text-white transition-colors">
                    Add User
                </a>
                <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-800 flex items-center gap-1 text-sm">
                    &larr; Back to Dashboard
                </a>
            </div>
        </div>
        
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Name
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Email
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Role
                    </th>
                     <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $user->name }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $user->email }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <span class="inline-block px-2 py-1 font-semibold leading-tight rounded-full {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : ($user->role === 'petugas' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700') }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:text-blue-900 mr-4">Edit</a>
                        @if(Auth::id() !== $user->id)
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
