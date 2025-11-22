<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index() {
        $rooms = Room::all();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create() {
        return view('admin.rooms.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'capacity' => 'required|integer',
            'location' => 'required|string',
            'description' => 'nullable|string'
        ]);

        Room::create($data);
        return redirect()->route('admin.rooms.index')->with('success', 'Ruang berhasil ditambahkan');
    }

    public function edit(Room $room) {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room) {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'capacity' => 'required|integer',
            'location' => 'required|string',
            'description' => 'nullable|string'
        ]);

        $room->update($data);
        return redirect()->route('admin.rooms.index')->with('success', 'Ruang berhasil diupdate');
    }

    public function destroy(Room $room) {
        // Opsional: Cek jadwal aktif sebelum hapus
        if ($room->reservations()->where('status', 'active')->exists()) {
            return back()->with('error', 'Gagal hapus: Masih ada jadwal aktif di ruang ini.');
        }
        
        $room->delete();
        return back()->with('success', 'Ruang dihapus.');
    }
}