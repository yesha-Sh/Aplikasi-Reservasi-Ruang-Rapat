<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data statistik untuk card dashboard
        $totalRooms = Room::count();
        $totalUsers = User::count();
        $activeReservations = Reservation::where('status', 'active')->count();

        // Mengirim data ke view admin dashboard
        return view('admin.dashboard', compact('totalRooms', 'totalUsers', 'activeReservations'));
    }
}