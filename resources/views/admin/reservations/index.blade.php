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
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Semua Reservasi Masuk</h1>
            <p class="text-gray-600">Monitor dan kelola semua reservasi ruangan</p>
        </div>
    </div>
</div>

<div class="glass-effect rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="tech-gradient text-white">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">User</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Ruang</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Jadwal</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-right text-sm font-semibold uppercase tracking-wider">Aksi Admin</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($reservations as $res)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="tech-gradient w-10 h-10 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                {{ strtoupper(substr($res->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="font-bold text-gray-900">{{ $res->user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $res->user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-gray-900">{{ $res->room->name }}</div>
                        <div class="text-xs text-gray-500 flex items-center mt-1">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $res->room->location }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($res->date)->translatedFormat('d M Y') }}</div>
                        <div class="text-sm text-gray-600 flex items-center mt-1">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ \Carbon\Carbon::parse($res->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($res->end_time)->format('H:i') }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($res->status === 'active')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                AKTIF
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                DIBATALKAN
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        @if($res->status === 'active')
                            <form action="{{ route('admin.reservations.cancel', $res->id) }}" method="POST" onsubmit="return confirm('Paksa batalkan reservasi ini?');">
                                @csrf
                                @method('PATCH')
                                <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-all duration-300 red-glow">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    FORCE CANCEL
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400 text-sm">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="text-gray-400 mb-4">
                            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <p class="text-gray-500 text-lg">Belum ada data reservasi.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection