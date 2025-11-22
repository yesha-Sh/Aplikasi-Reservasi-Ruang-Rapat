@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="glass-effect p-8 rounded-2xl border-t-4 border-red-500">
        <div class="mb-8">
            <div class="flex items-center space-x-4 mb-4">
                <a href="{{ route('admin.rooms.index') }}" class="inline-flex items-center text-gray-600 hover:text-red-600 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar Ruang
                </a>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Tambah Ruang Baru</h1>
            <p class="text-gray-600">Tambahkan fasilitas ruang meeting baru ke sistem</p>
        </div>

        <form action="{{ route('admin.rooms.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Ruang</label>
                    <input type="text" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300" placeholder="Masukkan nama ruang" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Kapasitas</label>
                        <input type="number" name="capacity" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300" placeholder="Jumlah orang" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Lokasi (Lantai/Gedung)</label>
                        <input type="text" name="location" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300" placeholder="Contoh: Lantai 5 - Gedung A" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi / Fasilitas</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300" placeholder="Jelaskan fasilitas dan fitur ruangan..."></textarea>
                </div>

                <div class="flex justify-end space-x-4 pt-6">
                    <a href="{{ route('admin.rooms.index') }}" class="px-6 py-3 text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition-all duration-300 font-semibold">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-3 tech-gradient text-white rounded-xl hover:shadow-lg transition-all duration-300 font-semibold red-glow">
                        Simpan Ruang
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection