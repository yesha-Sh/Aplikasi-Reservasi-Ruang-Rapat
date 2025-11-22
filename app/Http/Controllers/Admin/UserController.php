<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Ambil semua user, urutkan dari yang terbaru
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Mengubah role user menjadi admin.
     */
    public function promote(User $user)
    {
        // Validasi: Tidak boleh mengubah diri sendiri lewat tombol ini (opsional)
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat mengubah role anda sendiri di sini.');
        }

        // Toggle Role: Jika user -> admin, Jika admin -> user
        $newRole = $user->role === 'admin' ? 'user' : 'admin';
        
        $user->update(['role' => $newRole]);

        return back()->with('success', "Role pengguna {$user->name} berhasil diubah menjadi {$newRole}.");
    }
}