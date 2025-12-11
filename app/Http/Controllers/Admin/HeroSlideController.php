<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{
    /**
     * Display a listing of hero slides
     */
    public function index()
    {
        $slides = HeroSlide::with('user')->ordered()->get();
        return view('admin.hero-slides.index', compact('slides'));
    }

    /**
     * Show the form for creating a new hero slide
     */
    public function create()
    {
        return view('admin.hero-slides.create');
    }

    /**
     * Store a newly created hero slide
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'video_url' => 'nullable|url',
            'cta_text' => 'nullable|string|max:50',
            'cta_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['image'] = $request->file('image')
            ->store('hero-slides', 'public');
        
        $validated['user_id'] = Auth::id();
        $validated['is_active'] = $request->boolean('is_active', true);

        HeroSlide::create($validated);

        return redirect()->route('admin.hero-slides.index')
            ->with('success', 'Hero slide berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified hero slide
     */
    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero-slides.edit', compact('heroSlide'));
    }

    /**
     * Update the specified hero slide
     */
    public function update(Request $request, HeroSlide $heroSlide)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'video_url' => 'nullable|url',
            'cta_text' => 'nullable|string|max:50',
            'cta_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($heroSlide->image);
            $validated['image'] = $request->file('image')
                ->store('hero-slides', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        $heroSlide->update($validated);

        return redirect()->route('admin.hero-slides.index')
            ->with('success', 'Hero slide berhasil diperbarui!');
    }

    /**
     * Remove the specified hero slide
     */
    public function destroy(HeroSlide $heroSlide)
    {
        Storage::disk('public')->delete($heroSlide->image);
        $heroSlide->delete();

        return redirect()->route('admin.hero-slides.index')
            ->with('success', 'Hero slide berhasil dihapus!');
    }

    /**
     * Toggle hero slide status
     */
    public function toggleStatus(HeroSlide $heroSlide)
    {
        $heroSlide->update([
            'is_active' => !$heroSlide->is_active
        ]);

        return back()->with('success', 'Status hero slide berhasil diubah!');
    }

    /**
     * Reorder hero slides
     */
    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:hero_slides,id',
        ]);

        foreach ($validated['order'] as $index => $id) {
            HeroSlide::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
