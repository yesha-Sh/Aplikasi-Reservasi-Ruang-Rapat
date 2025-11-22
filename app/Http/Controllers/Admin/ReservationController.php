<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function showCancelForm(Reservation $reservation)
    {
        if ($reservation->status !== 'active') {
            return back()->with('error', 'Reservasi sudah tidak aktif.');
        }

        return view('admin.reservations.confirm-cancel', compact('reservation'));
    }

    public function cancel(Request $request, Reservation $reservation)
    {
        if ($reservation->status !== 'active') {
            return back()->with('error', 'Reservasi sudah tidak aktif.');
        }

        $request->validate([
            'password' => 'required|string'
        ]);

        // Verifikasi password admin
        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()->with('error', 'Password admin salah! Silakan coba lagi.');
        }

        // Admin berhak membatalkan reservasi siapa saja
        $reservation->update(['status' => 'cancelled']);

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservasi berhasil dibatalkan oleh Admin.');
    }
}