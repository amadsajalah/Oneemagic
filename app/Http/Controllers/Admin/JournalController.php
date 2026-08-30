<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JournalController extends Controller
{
    /**
     * READ, SEARCH, SORT
     */
    public function index(Request $request)
    {
        $query = Journal::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->search}%");
        }

        $sortDirection = $request->get('direction', 'desc');
        $query->orderBy('published_date', $sortDirection);

        $journals = $query->paginate(10);

        return view('admin.journals.index', compact('journals', 'sortDirection'));
    }

    /**
     * CREATE
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
        ]);

        $validated['slug']           = Str::slug($validated['title']) . '-' . time();
        $validated['published_date'] = now()->toDateString();

        Journal::create($validated);

        return back()->with('success', 'Jurnal berhasil dipublikasikan.');
    }

    /**
     * UPDATE
     */
    public function update(Request $request, Journal $journal)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_date' => 'required|date',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->title !== $journal->title) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        }

        if ($request->hasFile('image')) {
            if ($journal->image_path && Storage::disk('public')->exists($journal->image_path)) {
                Storage::disk('public')->delete($journal->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('journals', 'public');
        }

        $journal->update($validated);

        return back()->with('success', 'Jurnal berhasil diperbarui.');
    }

    /**
     * DELETE
     */
    public function destroy(Journal $journal)
    {
        if ($journal->image_path && Storage::disk('public')->exists($journal->image_path)) {
            Storage::disk('public')->delete($journal->image_path);
        }
        $journal->delete();

        return back()->with('success', 'Jurnal berhasil dihapus.');
    }
}
