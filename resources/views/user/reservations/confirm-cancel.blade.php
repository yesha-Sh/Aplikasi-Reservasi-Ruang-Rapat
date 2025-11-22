@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-xl shadow-tech border border-gray-100 p-6">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Konfirmasi Pembatalan</h2>
            <p class="text-gray-600">Masukkan password Anda untuk membatalkan reservasi</p>
        </div>

        <!-- Informasi Reservasi -->
        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <div class="flex items-center mb-3">
                <div class="w-10 h-10 rounded-lg bg-lightred flex items-center justify-center mr-3">
                    <i class="fas fa-door-open text-primary"></i>
                </div>
                <div>
                    <div class="font-semibold text-gray-900">{{ $reservation->room->name }}</div>
                    <div class="text-sm text-gray-500">{{ $reservation->room->location }}</div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-500">Tanggal:</span>
                    <div class="font-medium">{{ \Carbon\Carbon::parse($reservation->date)->translatedFormat('d M Y') }}</div>
                </div>
                <div>
                    <span class="text-gray-500">Waktu:</span>
                    <div class="font-medium">
                        {{ \Carbon\Carbon::parse($reservation->start_time)->format('H:i') }} - 
                        {{ \Carbon\Carbon::parse($reservation->end_time)->format('H:i') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Password -->
        <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST">
            @csrf
            @method('PATCH')
            
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Password Konfirmasi
                </label>
                <input 
                    type="password" 
                    name="password" 
                    id="password"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 @error('password') border-red-500 @enderror"
                    placeholder="Masukkan password Anda"
                    autocomplete="current-password"
                >
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <a href="{{ route('reservations.history') }}" 
                   class="flex-1 bg-gray-100 text-gray-700 py-3 px-4 rounded-lg font-semibold text-center hover:bg-gray-200 transition-colors duration-200">
                    Kembali
                </a>
                <button type="submit" 
                        class="flex-1 bg-red-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-red-700 transition-colors duration-200 red-glow">
                    <i class="fas fa-ban mr-2"></i>Batalkan Reservasi
                </button>
            </div>
        </form>
    </div>

    <!-- Security Note -->
    <div class="mt-4 text-center">
        <p class="text-xs text-gray-500">
            <i class="fas fa-shield-alt mr-1"></i>
            Kami memverifikasi password untuk keamanan akun Anda
        </p>
    </div>
</div>

<style>
.red-glow {
    box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
}
.red-glow:hover {
    box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
}
</style>
@endsection