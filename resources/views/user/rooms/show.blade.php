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
                
                <form action="{{ route('reservations.store') }}" method="POST" id="bookingForm">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    
                    <div class="mb-5">
                        <label class="block text-sm font-semibold mb-2 text-gray-700">Tanggal Reservasi</label>
                        <div class="relative">
                            <input type="date" name="date" id="reservationDate" min="{{ date('Y-m-d') }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" required>
                        </div>
                    </div>

                    <!-- Custom Time Picker -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold mb-3 text-gray-700">Pilih Waktu</label>
                        
                        <!-- Time Range Display -->
                        <div class="bg-gradient-to-r from-primary/10 to-darkred/10 border border-primary/20 rounded-xl p-4 mb-4">
                            <div class="text-center">
                                <div class="text-sm text-gray-600 mb-1">Waktu yang dipilih:</div>
                                <div class="text-lg font-bold text-primary" id="selectedTimeRange">
                                    --:-- - --:--
                                </div>
                            </div>
                        </div>

                        <!-- Time Picker Container -->
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Start Time -->
                            <div>
                                <label class="block text-sm font-semibold mb-2 text-gray-700">Jam Mulai</label>
                                <div class="relative">
                                    <select name="start_time" id="startTime" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 appearance-none cursor-pointer" required>
                                        <option value="">Pilih Jam</option>
                                        <!-- Options will be populated by JavaScript -->
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400 pointer-events-none"></i>
                                </div>
                            </div>

                            <!-- End Time -->
                            <div>
                                <label class="block text-sm font-semibold mb-2 text-gray-700">Jam Selesai</label>
                                <div class="relative">
                                    <select name="end_time" id="endTime" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 appearance-none cursor-pointer" disabled required>
                                        <option value="">Pilih Jam Mulai dulu</option>
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400 pointer-events-none"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Time Slots Info -->
                        <div class="mt-3 text-xs text-gray-500">
                            <div class="flex items-center justify-between">
                                <span>Setiap slot = 30 menit</span>
                                <span>Operasional: 08:00 - 17:00</span>
                            </div>
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

<style>
    /* Custom styling for select elements */
    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    
    /* Remove default arrow in IE */
    select::-ms-expand {
        display: none;
    }
    
    /* Custom scrollbar for select */
    select::-webkit-scrollbar {
        width: 6px;
    }
    
    select::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }
    
    select::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }
    
    select::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const startTimeSelect = document.getElementById('startTime');
    const endTimeSelect = document.getElementById('endTime');
    const selectedTimeRange = document.getElementById('selectedTimeRange');
    const reservationDate = document.getElementById('reservationDate');
    
    // Generate time slots from 08:00 to 17:00 in 30-minute intervals
    const timeSlots = [];
    for (let hour = 8; hour <= 17; hour++) {
        for (let minute = 0; minute < 60; minute += 30) {
            if (hour === 17 && minute > 0) break; // Stop at 17:00
            
            const timeString = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
            const displayTime = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
            timeSlots.push({ value: timeString, display: displayTime });
        }
    }
    
    // Populate start time options
    timeSlots.slice(0, -1).forEach(slot => {
        const option = document.createElement('option');
        option.value = slot.value;
        option.textContent = slot.display;
        startTimeSelect.appendChild(option);
    });
    
    // Start time change event
    startTimeSelect.addEventListener('change', function() {
        const selectedStartTime = this.value;
        
        if (selectedStartTime) {
            // Enable end time select
            endTimeSelect.disabled = false;
            endTimeSelect.innerHTML = '<option value="">Pilih Jam Selesai</option>';
            
            // Find index of selected start time
            const startIndex = timeSlots.findIndex(slot => slot.value === selectedStartTime);
            
            // Populate end time options (only times after start time)
            timeSlots.slice(startIndex + 1).forEach(slot => {
                const option = document.createElement('option');
                option.value = slot.value;
                option.textContent = slot.display;
                endTimeSelect.appendChild(option);
            });
            
            // Reset end time selection
            endTimeSelect.value = '';
            updateTimeRangeDisplay();
        } else {
            endTimeSelect.disabled = true;
            endTimeSelect.innerHTML = '<option value="">Pilih Jam Mulai dulu</option>';
            updateTimeRangeDisplay();
        }
    });
    
    // End time change event
    endTimeSelect.addEventListener('change', updateTimeRangeDisplay);
    
    // Update the time range display
    function updateTimeRangeDisplay() {
        const startTime = startTimeSelect.value;
        const endTime = endTimeSelect.value;
        
        if (startTime && endTime) {
            const startDisplay = startTime;
            const endDisplay = endTime;
            selectedTimeRange.textContent = `${startDisplay} - ${endDisplay}`;
            selectedTimeRange.classList.remove('text-gray-400');
            selectedTimeRange.classList.add('text-primary');
        } else {
            selectedTimeRange.textContent = '--:-- - --:--';
            selectedTimeRange.classList.remove('text-primary');
            selectedTimeRange.classList.add('text-gray-400');
        }
    }
    
    // Date change event - reset time selections
    reservationDate.addEventListener('change', function() {
        startTimeSelect.value = '';
        endTimeSelect.value = '';
        endTimeSelect.disabled = true;
        endTimeSelect.innerHTML = '<option value="">Pilih Jam Mulai dulu</option>';
        updateTimeRangeDisplay();
    });
    
    // Form validation
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        const startTime = startTimeSelect.value;
        const endTime = endTimeSelect.value;
        
        if (startTime && endTime) {
            const startMinutes = convertTimeToMinutes(startTime);
            const endMinutes = convertTimeToMinutes(endTime);
            
            if (endMinutes <= startMinutes) {
                e.preventDefault();
                alert('Jam selesai harus setelah jam mulai');
                return false;
            }
            
            // Minimum booking duration (30 minutes)
            if ((endMinutes - startMinutes) < 30) {
                e.preventDefault();
                alert('Durasi booking minimal 30 menit');
                return false;
            }
        }
    });
    
    // Helper function to convert time string to minutes
    function convertTimeToMinutes(timeString) {
        const [hours, minutes] = timeString.split(':').map(Number);
        return hours * 60 + minutes;
    }
    
    // Initialize
    updateTimeRangeDisplay();
});
</script>
@endsection