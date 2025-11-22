@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Daftar Ruang Rapat</h2>
            <p class="text-gray-600 mt-2">Pilih ruangan yang sesuai dengan kebutuhan meeting Anda</p>
        </div>
        <div class="flex items-center text-sm text-gray-500">
            <i class="fas fa-info-circle mr-2 text-primary"></i>
            <span>{{ count($rooms) }} ruangan tersedia</span>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($rooms as $room)
        <div class="bg-card rounded-xl shadow-tech hover:shadow-tech-lg transition-all duration-300 overflow-hidden border border-gray-100 glossy">
            <div class="h-2 bg-gradient-to-r from-primary to-darkred"></div>
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-xl font-bold text-gray-900">{{ $room->name }}</h3>
                    <div class="flex items-center bg-lightred text-primary px-3 py-1 rounded-full text-xs font-semibold">
                        <i class="fas fa-users mr-1"></i>
                        <span>{{ $room->capacity }} orang</span>
                    </div>
                </div>
                
                <div class="flex items-center text-gray-600 mb-3">
                    <i class="fas fa-map-marker-alt mr-2 text-primary text-sm"></i>
                    <span class="text-sm">{{ $room->location }}</span>
                </div>
                
                <p class="text-gray-500 text-sm mb-6 line-clamp-2">{{ $room->description }}</p>
                
                <a href="{{ route('rooms.show', $room->id) }}" class="flex items-center justify-center w-full btn-primary text-white font-semibold py-3 rounded-lg transition-all duration-300">
                    <i class="fas fa-calendar-plus mr-2"></i>
                    Lihat Detail & Pesan
                </a>
            </div>
        </div>
        @endforeach
    </div>
@endsection