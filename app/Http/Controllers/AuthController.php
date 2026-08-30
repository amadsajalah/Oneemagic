<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LogoutLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Controller untuk menangani Autentikasi Pengguna (Login, Register, Logout).
 * 
 * KONSEP OOP: Class ini bertindak sebagai CONTROLLER dalam arsitektur MVC.
 * Tugasnya adalah menjembatani interaksi antara View (tampilan) dan Model (database).
 */
class AuthController extends Controller
{
    /**
     * Menampilkan halaman Login.
     * 
     * @return \Illuminate\View\View
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Menampilkan halaman Login KHUSUS ADMIN.
     * URL: /admin-akses — terpisah dari login user biasa.
     */
    public function showAdminLogin()
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.admin-login');
    }

    /**
     * Memproses Login KHUSUS ADMIN.
     * Hanya berhasil jika akun yang digunakan ber-role 'admin'.
     */
    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->isAdmin()) {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }
            // Jika bukan admin, logout dan kembalikan error
            Auth::logout();
            return back()->withErrors([
                'email' => 'Akun ini bukan akun Administrator.',
            ])->onlyInput('email');
        }

        return back()->withErrors([
            'email' => 'Email atau sandi tidak valid.',
        ])->onlyInput('email');
    }

    /**
     * Memproses logika Login.
     * 
     * KONSEP OOP: Method ini mengenkapsulasi logika validasi dan autentikasi.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Proses Autentikasi
        if (Auth::attempt($credentials)) {
            // Cek: Jika yang login adalah Admin, TOLAK dan suruh pakai /admin-akses
            if (Auth::user()->isAdmin()) {
                Auth::logout(); // Paksa logout
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors([
                    'email' => 'Akun Admin tidak bisa masuk lewat halaman ini. Gunakan halaman khusus Admin.',
                ])->onlyInput('email');
            }

            // Ini customer biasa — arahkan ke dashboard user
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Selamat datang kembali!');
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ])->onlyInput('email');
    }

    /**
     * Menampilkan halaman Register.
     * 
     * @return \Illuminate\View\View
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Memproses logika Pendaftaran Pengguna.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // KONSEP OOP: Instansiasi objek User baru
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'customer', // Default role
        ]);

        // Login otomatis setelah mendaftar
        Auth::login($user);

        // Langsung ke dashboard klien
        return redirect()->route('dashboard')->with('success', 'Akun berhasil dibuat. Selamat datang di OneeMagic!');
    }

    /**
     * Memproses logika Logout dengan mencatat log ke database.
     * 
     * KONSEP OOP: Di sini kita melihat INTERAKSI ANTAR OBJEK.
     * Controller meminta Model (LogoutLog) untuk menyimpan data,
     * sebelum akhirnya menghancurkan sesi melalui Facade Auth.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // 1. Ambil objek User yang sedang login
        $user = Auth::user();

        if ($user) {
            // 2. Catat log keluar ke database MENGGUNAKAN RELASI OOP
            // Ini memanggil method logoutLogs() yang didefinisikan di Model User
            $user->logoutLogs()->create([
                'ip_address'    => $request->ip(),
                'logged_out_at' => now(),
            ]);
        }

        // 3. Proses Logout bawaan Laravel
        Auth::logout();

        // 4. Invalidate sesi untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah berhasil keluar dari dunia magis.');
    }
}
