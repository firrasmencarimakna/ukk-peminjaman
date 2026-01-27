@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold">Tool Management</h2>
            <div class="flex items-center gap-6">
                 <a href="{{ route('admin.tools.create') }}" class="inline-flex items-center px-4 py-2 border border-black rounded text-xs font-bold hover:bg-black hover:text-white transition-colors">
                    Add Tool
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
                        Category
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Stock
                    </th>
                     <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($tools as $tool)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $tool->name }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $tool->category->name }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $tool->stock }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('admin.tools.edit', $tool->id) }}" class="text-blue-600 hover:text-blue-900 mr-4">Edit</a>
                        <form action="{{ route('admin.tools.destroy', $tool->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
