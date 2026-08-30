<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    public function create()
    {
        return view('booking');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date|after:today',
            'event_time' => 'required',
            'event_location' => 'required|string|max:255',
            'guest_count' => 'required|integer|min:1',
            'special_requests' => 'nullable|string'
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        Booking::create($validated);

        return redirect()->route('dashboard')->with('success', 'Permintaan pemesanan Anda telah terkirim! Magician kami akan segera meninjaunya.');
    }

    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->load(['messages.sender']);
        return view('booking_detail', compact('booking'));
    }

    public function storeMessage(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'message' => 'nullable|string|max:1000',
            'attachment' => 'nullable|image|mimes:jpeg,png,jpg|max:5120'
        ]);

        if (!$request->message && !$request->hasFile('attachment')) {
            return back()->with('error', 'Pesan tidak boleh kosong.');
        }

        $path = null;
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('chat_attachments', 'public');
        }

        BookingMessage::create([
            'booking_id' => $booking->id,
            'sender_id' => Auth::id(),
            'sender_role' => 'customer',
            'message' => $request->message,
            'attachment' => $path
        ]);

        return back()->with('success', 'Pesan terkirim.');
    }



    public function destroy(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Hanya pemesanan dengan status Menunggu yang dapat dibatalkan.');
        }

        $booking->delete();

        return redirect()->route('dashboard')->with('success', 'Pemesanan Anda berhasil dibatalkan.');
    }

    public function deleteMessage(BookingMessage $message)
    {
        // Hanya pengirimnya sendiri yang boleh hapus
        if ($message->sender_id !== Auth::id()) {
            abort(403);
        }

        $bookingId = $message->booking_id;

        // Hapus file lampiran jika ada
        if ($message->attachment) {
            Storage::disk('public')->delete($message->attachment);
        }

        $message->delete();

        return redirect()->route('booking.show', $bookingId)->with('success', 'Pesan berhasil dihapus.');
    }
}
