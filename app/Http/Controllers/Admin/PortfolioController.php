<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Category;
use App\Models\MagicianProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * READ, SEARCH, SORT
     */
    public function index(Request $request)
    {
        $query = Portfolio::with('category');

        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->search}%");
        }

        $sortDirection = $request->get('direction', 'desc');
        $query->orderBy('event_year', $sortDirection);

        $portfolios = $query->paginate(10);
        $categories = Category::all();
        $profile = MagicianProfile::firstOrCreate(['id' => 1], ['name' => 'Onee']);

        return view('admin.portfolios.index', compact('portfolios', 'categories', 'sortDirection', 'profile'));
    }

    /**
     * UPDATE PROFILE
     */
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'tiktok_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|max:2048'
        ]);

        $profile = MagicianProfile::firstOrCreate(['id' => 1]);

        if ($request->hasFile('image')) {
            if ($profile->image_path && Storage::disk('public')->exists($profile->image_path)) {
                Storage::disk('public')->delete($profile->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('profiles', 'public');
        }

        $profile->update($validated);

        return back()->with('success', 'Profil Magician berhasil diperbarui.');
    }

    /**
     * CREATE
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'description' => 'required|string',
            'event_year'  => 'required|integer|min:2000|max:2100',
            'image'       => 'nullable|image|max:2048',
            'video_url'   => 'nullable|string',
            'video_type'  => 'nullable|in:youtube,mp4',
            'video_file'  => 'nullable|mimes:mp4,mov,ogg,qt|max:204800', // 200MB max
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('portfolios', 'public');
            $validated['image_path'] = $path;
        }

        if ($request->hasFile('video_file')) {
            $videoPath = $request->file('video_file')->store('portfolios/videos', 'public');
            $validated['video_url'] = $videoPath;
            $validated['video_type'] = 'mp4';
        }

        Portfolio::create($validated);

        return back()->with('success', 'Portofolio berhasil ditambahkan.');
    }

    /**
     * UPDATE
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'description' => 'required|string',
            'event_year' => 'required|integer|min:2000|max:2100',
            'image' => 'nullable|image|max:2048',
            'video_url' => 'nullable|string',
            'video_type' => 'nullable|in:youtube,mp4',
            'video_file' => 'nullable|mimes:mp4,mov,ogg,qt|max:204800', // 200MB max
        ]);

        if ($request->hasFile('image')) {
            if ($portfolio->image_path && Storage::disk('public')->exists($portfolio->image_path)) {
                Storage::disk('public')->delete($portfolio->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('portfolios', 'public');
        }

        if ($request->hasFile('video_file')) {
            // Check if old video was a file and delete it
            if ($portfolio->video_url && $portfolio->video_type === 'mp4' && Storage::disk('public')->exists($portfolio->video_url)) {
                Storage::disk('public')->delete($portfolio->video_url);
            }
            $videoPath = $request->file('video_file')->store('portfolios/videos', 'public');
            $validated['video_url'] = $videoPath;
            $validated['video_type'] = 'mp4';
        }

        $portfolio->update($validated);

        return back()->with('success', 'Portofolio berhasil diperbarui.');
    }

    /**
     * DELETE
     */
    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->image_path && Storage::disk('public')->exists($portfolio->image_path)) {
            Storage::disk('public')->delete($portfolio->image_path);
        }
        
        if ($portfolio->video_url && $portfolio->video_type === 'mp4' && Storage::disk('public')->exists($portfolio->video_url)) {
            Storage::disk('public')->delete($portfolio->video_url);
        }

        $portfolio->delete();

        return back()->with('success', 'Portofolio berhasil dihapus.');
    }
}
