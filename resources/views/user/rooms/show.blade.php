@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Room Information -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-tech overflow-hidden border border-gray-100">
            <div class="h-2 bg-gradient-to-r from-primary to-darkred"></div>
            <div class="p-6">
                <div class="flex justify-between items-start mb-6">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $room->name }}</h1>
                    <div class="flex items-center bg-lightred text-primary px-4 py-2 rounded-full font-semibold">
                        <i class="fas fa-users mr-2"></i>
                        <span>{{ $room->capacity }} orang</span>
                    </div>
                </div>
                
                <div class="flex items-center text-gray-700 mb-6">
                    <i class="fas fa-map-marker-alt mr-3 text-primary"></i>
                    <span class="font-medium">{{ $room->location }}</span>
                </div>
                
                <p class="text-gray-600 mb-8 leading-relaxed">{{ $room->description }}</p>
                
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="font-bold text-lg mb-4 flex items-center">
                        <i class="fas fa-calendar-day mr-2 text-primary"></i>
                        Jadwal Hari Ini ({{ date('d M Y') }})
                    </h3>
                    <div class="space-y-3">
                        @forelse($todayReservations as $res)
                            <div class="bg-gray-50 p-3 rounded-lg flex justify-between items-center">
                                <div class="flex items-center">
                                    <i class="far fa-clock text-primary mr-2"></i>
                                    <span class="font-medium">{{ substr($res->start_time, 0, 5) }} - {{ substr($res->end_time, 0, 5) }}</span>
                                </div>
                                <span class="text-gray-500 text-sm font-medium">Terisi</span>
                            </div>
                        @empty
                            <div class="text-center py-4 text-gray-400">
                                <i class="fas fa-calendar-check text-2xl mb-2"></i>
                                <p class="font-medium">Tidak ada jadwal hari ini</p>
                                <p class="text-sm mt-1">Ruangan tersedia sepanjang hari</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Booking Form -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-tech-lg border-t-4 border-primary sticky top-24">
            <div class="p-6">
                <h3 class="text-xl font-bold mb-2 flex items-center">
                    <i class="fas fa-calendar-plus mr-2 text-primary"></i>
                    Buat Reservasi Baru
                </h3>
                <p class="text-gray-600 text-sm mb-6">Isi formulir untuk memesan ruangan ini</p>
                
                <form action="{{ route('reservations.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    
                    <div class="mb-5">
                        <label class="block text-sm font-semibold mb-2 text-gray-700">Tanggal Reservasi</label>
                        <div class="relative">
                            <input type="date" name="date" min="{{ date('Y-m-d') }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" required>
                            <i class="fas fa-calendar-alt absolute right-3 top-3 text-gray-400"></i>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700">Jam Mulai</label>
                            <div class="relative">
                                <input type="time" name="start_time" min="08:00" max="17:00" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" required>
                                <i class="far fa-clock absolute right-3 top-3 text-gray-400"></i>
                            </div>
                            <small class="text-gray-500 text-xs mt-1 block">Min 08:00</small>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700">Jam Selesai</label>
                            <div class="relative">
                                <input type="time" name="end_time" min="08:00" max="17:00" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" required>
                                <i class="far fa-clock absolute right-3 top-3 text-gray-400"></i>
                            </div>
                            <small class="text-gray-500 text-xs mt-1 block">Max 17:00</small>
                        </div>
                    </div>

                    <button type="submit" class="w-full btn-primary text-white font-bold py-3.5 rounded-lg transition-all duration-300 flex items-center justify-center shadow-tech">
                        <i class="fas fa-check-circle mr-2"></i>
                        Booking Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection