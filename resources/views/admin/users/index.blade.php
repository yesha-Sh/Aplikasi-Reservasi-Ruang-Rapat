@extends('layouts.app')

@section('content')
<div class="mb-8">
    <div class="flex justify-between items-center">
        <div>
            <div class="flex items-center space-x-4 mb-4">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-gray-600 hover:text-red-600 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Manajemen Pengguna</h1>
            <p class="text-gray-600">Kelola akses dan peran pengguna sistem</p>
        </div>
    </div>
</div>

<div class="glass-effect rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="tech-gradient text-white">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">User</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Email</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Role</th>
                    <th class="px-6 py-4 text-right text-sm font-semibold uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="tech-gradient w-10 h-10 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div class="font-medium text-gray-900">{{ $user->name }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        @if($user->role === 'admin')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                ADMIN
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-800">
                                USER
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        @if(Auth::id() !== $user->id)
                            <form action="{{ route('admin.users.promote', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                @if($user->role === 'user')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white tech-gradient rounded-lg hover:shadow-lg transition-all duration-300">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                        Jadikan Admin
                                    </button>
                                @else
                                    <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-all duration-300">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Hapus Admin
                                    </button>
                                @endif
                            </form>
                        @else
                            <span class="text-gray-400 text-sm italic">Diri Sendiri</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection