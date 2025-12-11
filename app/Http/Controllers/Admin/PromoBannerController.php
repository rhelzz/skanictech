<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromoBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PromoBannerController extends Controller
{
    /**
     * Display a listing of promo banners
     */
    public function index()
    {
        $banners = PromoBanner::with('user')->ordered()->get();
        return view('admin.promo-banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new promo banner
     */
    public function create()
    {
        return view('admin.promo-banners.create');
    }

    /**
     * Store a newly created promo banner
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|url',
            'position' => 'required|in:top,middle,bottom',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
        
        $validated['user_id'] = Auth::id();
        $validated['is_active'] = $request->boolean('is_active', true);

        PromoBanner::create($validated);

        return redirect()->route('admin.promo-banners.index')
            ->with('success', 'Banner promo berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified promo banner
     */
    public function edit(PromoBanner $promoBanner)
    {
        return view('admin.promo-banners.edit', compact('promoBanner'));
    }

    /**
     * Update the specified promo banner
     */
    public function update(Request $request, PromoBanner $promoBanner)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|url',
            'position' => 'required|in:top,middle,bottom',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        $promoBanner->update($validated);

        return redirect()->route('admin.promo-banners.index')
            ->with('success', 'Banner promo berhasil diperbarui!');
    }

    /**
     * Remove the specified promo banner
     */
    public function destroy(PromoBanner $promoBanner)
    {
        $promoBanner->delete();

        return redirect()->route('admin.promo-banners.index')
            ->with('success', 'Banner promo berhasil dihapus!');
    }

    /**
     * Toggle promo banner status
     */
    public function toggleStatus(PromoBanner $promoBanner)
    {
        $promoBanner->update([
            'is_active' => !$promoBanner->is_active
        ]);

        return back()->with('success', 'Status banner promo berhasil diubah!');
    }
}
