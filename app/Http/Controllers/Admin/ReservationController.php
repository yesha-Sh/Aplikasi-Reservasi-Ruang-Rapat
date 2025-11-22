<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        // Ambil semua reservasi dengan relasi user dan room agar efisien (Eager Loading)
        $reservations = Reservation::with(['user', 'room'])
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();

        return view('admin.reservations.index', compact('reservations'));
    }

    public function cancel(Reservation $reservation)
    {
        // Admin berhak membatalkan reservasi siapa saja
        $reservation->update(['status' => 'cancelled']);

        return back()->with('success', 'Reservasi berhasil dibatalkan oleh Admin.');
    }
}