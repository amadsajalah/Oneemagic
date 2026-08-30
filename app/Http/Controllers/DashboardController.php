<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dasbor.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Mengambil riwayat login/logout jika ingin ditampilkan (opsional)
        $logoutHistory = $user->logoutLogs()->orderBy('logged_out_at', 'desc')->take(5)->get();
        $bookings = $user->bookings()->orderBy('created_at', 'desc')->get();

        return view('dashboard', compact('user', 'logoutHistory', 'bookings'));
    }
}
