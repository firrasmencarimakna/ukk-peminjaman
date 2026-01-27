@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden md:max-w-lg">
    <div class="md:flex">
        <div class="w-full p-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Edit User</h2>
                <a href="{{ route('admin.users.index') }}" class="text-gray-500 hover:text-gray-800 flex items-center gap-1 text-sm">
                    &larr; Back to List
                </a>
            </div>
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Name
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" name="name" value="{{ $user->name }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" name="email" value="{{ $user->email }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password (Leave blank to keep current)
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
                        Role
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="role" name="role" required>
                        <option value="peminjam" {{ $user->role === 'peminjam' ? 'selected' : '' }}>Peminjam</option>
                        <option value="petugas" {{ $user->role === 'petugas' ? 'selected' : '' }}>Petugas</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Update
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
