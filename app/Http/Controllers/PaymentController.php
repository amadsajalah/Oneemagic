<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function initiatePayment(Booking $booking)
    {
        // Pastikan hanya pemilik booking yang bisa bayar
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Pastikan status booking sudah disetujui
        if ($booking->status !== 'approved') {
            return back()->with('error', 'Pemesanan ini belum disetujui, tidak bisa melakukan pembayaran.');
        }

        // Pastikan harga sudah di-set
        if (!$booking->price) {
            return back()->with('error', 'Harga belum ditentukan oleh Admin.');
        }

        // Jika sudah lunas
        if ($booking->payment_status === 'paid') {
            return back()->with('success', 'Pembayaran sudah lunas.');
        }

        // Buat order id yang unik
        $orderId = 'BOOKING-' . $booking->id . '-' . time();

        // Parameter midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $booking->price,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'item_details' => [
                [
                    'id' => 'MAGIC-' . $booking->id,
                    'price' => $booking->price,
                    'quantity' => 1,
                    'name' => 'Paket Pertunjukan: ' . $booking->event_name,
                ]
            ],
            'callbacks' => [
                'finish' => route('payment.finish', $booking->id)
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            
            // Simpan token ke database untuk dipakai di frontend
            $booking->update([
                'midtrans_snap_token' => $snapToken
            ]);

            return back();
            
        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal memproses pembayaran. Coba lagi nanti.');
        }
    }

    public function paymentFinish(Request $request, Booking $booking)
    {
        // Midtrans mengirimkan order_id, status_code, dan transaction_status di URL parameter
        $status = $request->transaction_status;

        if (in_array($status, ['capture', 'settlement'])) {
            $booking->update(['payment_status' => 'paid', 'status' => 'paid']);
            return redirect()->route('payment.success.page', $booking);
        } elseif ($status === 'pending') {
            $booking->update(['payment_status' => 'pending']);
            return redirect()->route('booking.show', $booking)->with('success', 'Pembayaran Anda sedang diproses (Pending).');
        }

        return redirect()->route('booking.show', $booking);
    }

    public function paymentSuccessPage(Booking $booking)
    {
        return view('payment_success', compact('booking'));
    }

    public function resetToken(Booking $booking)
    {
        if ($booking->user_id === auth()->id()) {
            $booking->update(['midtrans_snap_token' => null]);
        }
        return response()->json(['success' => true]);
    }

    public function paymentSuccess(Booking $booking)
    {
        if ($booking->user_id === auth()->id()) {
            $booking->update(['payment_status' => 'paid', 'status' => 'paid']);
        }
        return response()->json(['success' => true, 'redirect' => route('payment.success.page', $booking)]);
    }

    public function paymentPending(Booking $booking)
    {
        if ($booking->user_id === auth()->id()) {
            $booking->update(['payment_status' => 'pending']);
        }
        return response()->json(['success' => true]);
    }

    public function requestRefund(Request $request, Booking $booking)
    {
        if ($booking->user_id === auth()->id() && $booking->payment_status === 'paid') {
            $request->validate([
                'refund_reason' => 'required|string|max:500',
                'new_event_name' => 'nullable|string|max:255',
                'new_event_date' => 'nullable|date|after:today',
                'new_event_time' => 'nullable|date_format:H:i',
            ]);

            $data = [
                'refund_status' => 'requested',
                'refund_reason' => $request->refund_reason,
            ];

            // If user wants to reschedule, save the new details in the reason field as context
            $changes = [];
            if ($request->new_event_name) $changes[] = 'Nama Acara Baru: ' . $request->new_event_name;
            if ($request->new_event_date) $changes[] = 'Tanggal Baru: ' . $request->new_event_date;
            if ($request->new_event_time) $changes[] = 'Waktu Baru: ' . $request->new_event_time;

            if (!empty($changes)) {
                $data['refund_reason'] = $request->refund_reason . "\n\n[Permintaan Perubahan]\n" . implode("\n", $changes);
                // Also apply the changes directly so admin can see them
                if ($request->new_event_name) $data['event_name'] = $request->new_event_name;
                if ($request->new_event_date) $data['event_date'] = $request->new_event_date;
                if ($request->new_event_time) $data['event_time'] = $request->new_event_time;
            }

            $booking->update($data);
            return back()->with('success', 'Pengajuan berhasil dikirim. Menunggu persetujuan admin.');
        }
        return back()->with('error', 'Tidak dapat mengajukan refund.');
    }

    public function webhook(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        
        // Validasi signature key untuk memastikan ini benar-benar dari midtrans
        if ($hashed == $request->signature_key) {
            
            // Extract booking ID dari format BOOKING-{ID}-{TIME}
            $parts = explode('-', $request->order_id);
            if (count($parts) >= 2 && $parts[0] === 'BOOKING') {
                $bookingId = $parts[1];
                $booking = Booking::find($bookingId);
                
                if ($booking) {
                    $transactionStatus = $request->transaction_status;
                    $paymentType = $request->payment_type;
                    
                    if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                        $booking->update([
                            'payment_status' => 'paid',
                            'midtrans_transaction_id' => $request->transaction_id,
                            'payment_method' => $paymentType
                        ]);
                    } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
                        $booking->update([
                            'payment_status' => 'failed',
                        ]);
                    } else if ($transactionStatus == 'pending') {
                        $booking->update([
                            'payment_status' => 'pending',
                        ]);
                    }
                }
            }
        }
        
        return response()->json(['status' => 'success']);
    }

    public function finish(Request $request)
    {
        return view('payment.finish', compact('request'));
    }
    
    public function unfinish(Request $request)
    {
        return view('payment.unfinish', compact('request'));
    }
    
    public function error(Request $request)
    {
        return view('payment.error', compact('request'));
    }
}
