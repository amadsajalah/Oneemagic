<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;

class PublicJournalController extends Controller
{
    public function index()
    {
        $journals = Journal::orderBy('published_date', 'desc')->paginate(12);
        return view('journal', compact('journals'));
    }

    public function show($slug)
    {
        $journal = Journal::where('slug', $slug)->firstOrFail();
        return view('journal-show', compact('journal'));
    }
}
