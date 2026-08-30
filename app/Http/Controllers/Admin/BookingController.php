<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    /**
     * READ, SEARCH, SORT
     */
    public function index(Request $request)
    {
        $query = Booking::with('user');

        // SEARCH
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhere('event_name', 'like', "%{$search}%");
        }

        // SORT
        $sortField = $request->get('sort', 'event_date');
        $sortDirection = $request->get('direction', 'asc');
        $query->orderBy($sortField, $sortDirection);

        $bookings = $query->paginate(10);

        return view('admin.bookings.index', compact('bookings', 'sortField', 'sortDirection'));
    }

    /**
     * SHOW DETAIL PAGE
     */
    public function show(Booking $booking)
    {
        $booking->load(['user', 'messages.sender']);
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * UPDATE STATUS
     */
    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $booking->update(['status' => $request->status]);

        return back()->with('success', 'Status pemesanan berhasil diperbarui.');
    }

    /**
     * UPDATE HARGA DEAL
     */
    public function updatePrice(Request $request, Booking $booking)
    {
        $request->validate([
            'price' => 'required|numeric|min:0'
        ]);

        $updates = [
            'price' => $request->price,
            'midtrans_snap_token' => null, // Reset token agar user generate baru dengan harga terbaru
        ];
        if ($booking->status === 'pending') {
            $updates['status'] = 'approved';
        }

        $booking->update($updates);

        return back()->with('success', 'Harga deal berhasil disimpan/diperbarui.');
    }

    /**
     * VERIFY PAYMENT
     */
    public function verifyPayment(Request $request, Booking $booking)
    {
        $request->validate([
            'payment_status' => 'required|in:paid,failed'
        ]);

        if ($request->payment_status === 'paid') {
            $booking->update([
                'payment_status' => 'paid',
                'status' => 'paid',
            ]);
            return back()->with('success', 'Pembayaran telah diverifikasi. Pemesanan selesai!');
        } else {
            // Bukti ditolak → reset snap token agar user bisa generate baru
            $booking->update([
                'payment_status' => 'failed',
                'status' => 'approved',
                'midtrans_snap_token' => null,
            ]);
            return back()->with('success', 'Bukti pembayaran ditolak. Klien akan diminta mengunggah ulang.');
        }
    }

    /**
     * STORE CHAT MESSAGE
     */
    public function storeMessage(Request $request, Booking $booking)
    {
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
            'sender_role' => 'admin',
            'message' => $request->message,
            'attachment' => $path
        ]);

        return back()->with('success', 'Pesan terkirim.');
    }

    public function updateRefund(Request $request, Booking $booking)
    {
        $request->validate([
            'action' => 'required|in:approve,reject,reschedule',
            'new_price' => 'nullable|numeric|min:0',
        ]);

        if ($booking->refund_status !== 'requested') {
            return back()->with('error', 'Tidak ada pengajuan refund yang valid.');
        }

        if ($request->action === 'approve' || $request->action === 'reschedule') {
            // Approve the refund/reschedule: clear payment status so user must pay again
            $data = [
                'refund_status' => null,
                'refund_reason' => null,
                'payment_status' => 'unpaid',
                'midtrans_snap_token' => null,
                'midtrans_transaction_id' => null,
                'status' => 'approved', // keep approved so they can pay
            ];
            
            if ($request->new_price && $request->new_price > 0) {
                $data['price'] = $request->new_price;
            }
            
            $booking->update($data);
            return back()->with('success', 'Refund/Perubahan disetujui. Pemesanan dikembalikan ke status Belum Bayar.');
        } else {
            $booking->update(['refund_status' => 'rejected']);
            return back()->with('success', 'Refund ditolak.');
        }
    }

    public function deleteMessage(BookingMessage $message)
    {
        $bookingId = $message->booking_id;

        // Hapus file lampiran jika ada
        if ($message->attachment) {
            Storage::disk('public')->delete($message->attachment);
        }

        $message->delete();

        return redirect()->route('admin.bookings.show', $bookingId)->with('success', 'Pesan berhasil dihapus.');
    }
}
