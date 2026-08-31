<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicPortfolioController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $profile = \App\Models\MagicianProfile::firstOrCreate(['id' => 1], ['name' => 'Onee']);
        
        $activeCategory = null;
        $query = Portfolio::with('category')->orderBy('event_year', 'desc');

        if ($request->has('category')) {
            $activeCategory = Category::where('slug', $request->category)->first();
        }

        $portfolios = $query->get();
        
        return view('portfolio', compact('portfolios', 'categories', 'profile', 'activeCategory'));
    }
}
