<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicMagicLabController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::all();
        return view('magic_lab', compact('categories'));
    }
}
