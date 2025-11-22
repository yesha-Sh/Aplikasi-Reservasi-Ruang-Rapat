<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Menampilkan daftar semua ruang rapat.
     */
    public function index()
    {
        $rooms = Room::all();
        return view('user.dashboard', compact('rooms'));
    }

    /**
     * Menampilkan detail satu ruang beserta jadwal hari ini.
     */
    public function showRoom(Room $room)
    {
        // Ambil jadwal aktif hari ini untuk ditampilkan di sidebar info
        $todayReservations = Reservation::where('room_id', $room->id)
            ->whereDate('date', Carbon::today())
            ->where('status', 'active')
            ->orderBy('start_time')
            ->get();

        return view('user.rooms.show', compact('room', 'todayReservations'));
    }
}