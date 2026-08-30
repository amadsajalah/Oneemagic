<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller untuk mengelola halaman publik.
 */
class HomeController extends Controller
{
    /**
     * Menampilkan Halaman Utama (Beranda).
     */
    public function index()
    {
        return view('home');
    }
}
