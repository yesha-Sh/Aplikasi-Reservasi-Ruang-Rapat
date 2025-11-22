@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-history text-primary mr-3"></i>
                Riwayat Reservasi Saya
            </h2>
            <p class="text-gray-600 mt-2">Kelola dan pantau semua reservasi ruangan Anda</p>
        </div>
        <div class="text-sm text-gray-500 flex items-center">
            <i class="fas fa-filter mr-2 text-primary"></i>
            <span>{{ count($reservations) }} reservasi</span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-tech overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Ruangan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal & Waktu</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($reservations as $res)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-lightred flex items-center justify-center mr-3">
                                    <i class="fas fa-door-open text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-gray-900">{{ $res->room->name }}</div>
                                    <div class="text-xs text-gray-500 flex items-center mt-1">
                                        <i class="fas fa-map-marker-alt mr-1 text-xs"></i>
                                        {{ $res->room->location }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($res->date)->translatedFormat('d M Y') }}</div>
                            <div class="text-sm text-gray-500 flex items-center mt-1">
                                <i class="far fa-clock mr-1 text-xs"></i>
                                {{ \Carbon\Carbon::parse($res->start_time)->format('H:i') }} - 
                                {{ \Carbon\Carbon::parse($res->end_time)->format('H:i') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($res->status === 'active')
                                <span class="status-badge bg-green-100 text-green-800 flex items-center w-fit">
                                    <i class="fas fa-check-circle mr-1 text-xs"></i>
                                    Aktif
                                </span>
                            @else
                                <span class="status-badge bg-red-100 text-red-800 flex items-center w-fit">
                                    <i class="fas fa-times-circle mr-1 text-xs"></i>
                                    Dibatalkan
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            @if($res->status === 'active')
                                <form action="{{ route('reservations.cancel', $res->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan reservasi ini?');">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold transition-colors duration-200 flex items-center justify-end w-full">
                                        <i class="fas fa-ban mr-1"></i> Batalkan
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400 italic text-sm">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <i class="fas fa-calendar-times text-4xl mb-3"></i>
                                <p class="text-lg font-medium">Belum ada riwayat reservasi</p>
                                <p class="text-sm mt-1">Mulai dengan membuat reservasi ruangan pertama Anda</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection