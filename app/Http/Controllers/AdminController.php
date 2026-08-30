<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Portfolio;
use App\Models\Journal;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers    = User::where('role', 'user')->count();
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $totalPortfolios = Portfolio::count();
        $totalJournals   = Journal::count();

        $recentBookings = Booking::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalBookings',
            'pendingBookings',
            'totalPortfolios',
            'totalJournals',
            'recentBookings'
        ));
    }
}
