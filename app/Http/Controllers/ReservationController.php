<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i|after_or_equal:08:00|before:17:00',
            'end_time' => 'required|date_format:H:i|after:start_time|before_or_equal:17:00',
        ]);

        // Cek Overlap (Inti Sistem)
        // Logic: (StartA < EndB) AND (EndA > StartB)
        $isConflict = Reservation::where('room_id', $request->room_id)
            ->where('date', $request->date)
            ->where('status', 'active')
            ->where('start_time', '<', $request->end_time)
            ->where('end_time', '>', $request->start_time)
            ->exists();

        if ($isConflict) {
            return back()->with('error', 'Ruangan sudah dibooking pada jam tersebut!');
        }

        Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'active'
        ]);

        return redirect()->route('reservations.history')->with('success', 'Reservasi berhasil dibuat!');
    }

    public function history() {
        $reservations = Reservation::where('user_id', Auth::id())
            ->with('room')
            ->orderBy('date', 'desc')
            ->get();
            
        return view('user.reservations.index', compact('reservations'));
    }

    public function cancel(Reservation $reservation) {
        // Pastikan milik user sendiri
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        $reservation->update(['status' => 'cancelled']);
        return back()->with('success', 'Reservasi dibatalkan.');
    }
}