<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of products
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $query = $user->isSuperAdmin() 
            ? Product::with(['category', 'user'])
            : Product::where('user_id', $user->id)->with('category');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('owner_name', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::active()->ordered()->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new product
     */
    public function create()
    {
        $categories = Category::active()->ordered()->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'price_type' => 'required|in:monthly,yearly,one_time',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'demo_url' => 'nullable|url',
            'demo_username' => 'nullable|string|max:255',
            'demo_password' => 'nullable|string|max:255',
            'owner_name' => 'required|string|max:255',
            'owner_whatsapp' => 'required|string|max:20',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
            'is_featured' => 'nullable|boolean',
        ]);

        // Handle main/thumbnail image upload (required)
        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request->file('main_image')->store('products/main', 'public');
        }

        // Handle gallery images upload (optional)
        if ($request->hasFile('gallery_images')) {
            $galleryImages = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('products/gallery', 'public');
            }
            $validated['gallery_images'] = $galleryImages;
        }

        // Filter empty features
        if (isset($validated['features'])) {
            $validated['features'] = array_filter($validated['features']);
        }

        $validated['user_id'] = Auth::id();
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['slug'] = Str::slug($validated['name']);

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified product
     */
    public function show(Product $product)
    {
        $this->authorizeProduct($product);
        
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product
     */
    public function edit(Product $product)
    {
        $this->authorizeProduct($product);
        
        $categories = Category::active()->ordered()->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product
     */
    public function update(Request $request, Product $product)
    {
        $this->authorizeProduct($product);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'price_type' => 'required|in:monthly,yearly,one_time',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'demo_url' => 'nullable|url',
            'demo_username' => 'nullable|string|max:255',
            'demo_password' => 'nullable|string|max:255',
            'owner_name' => 'required|string|max:255',
            'owner_whatsapp' => 'required|string|max:20',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
            'is_featured' => 'nullable|boolean',
        ]);

        // Handle main image upload and replacement
        if ($request->hasFile('main_image')) {
            // Delete old main image if exists
            if ($product->main_image && !str_starts_with($product->main_image, 'http')) {
                Storage::disk('public')->delete($product->main_image);
            }
            $validated['main_image'] = $request->file('main_image')->store('products/main', 'public');
        }

        // Handle gallery image removal first
        $currentGallery = $product->gallery_images_array;
        if ($request->has('remove_gallery_images')) {
            $toRemove = $request->remove_gallery_images;
            foreach ($toRemove as $index) {
                if (isset($currentGallery[$index])) {
                    // Only delete if it's a local path (not a URL)
                    if (!str_starts_with($currentGallery[$index], 'http')) {
                        Storage::disk('public')->delete($currentGallery[$index]);
                    }
                    unset($currentGallery[$index]);
                }
            }
            $currentGallery = array_values($currentGallery);
        }

        // Handle gallery images upload - add to existing
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $currentGallery[] = $image->store('products/gallery', 'public');
            }
        }
        
        // Update gallery images
        if (count($currentGallery) > 0 || $request->has('remove_gallery_images') || $request->hasFile('gallery_images')) {
            $validated['gallery_images'] = $currentGallery;
        } else {
            // No changes to gallery
            unset($validated['gallery_images']);
        }

        // Filter empty features
        if (isset($validated['features'])) {
            $validated['features'] = array_filter($validated['features']);
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        // Update slug if name changed
        if ($product->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
            $originalSlug = $validated['slug'];
            $count = 1;
            while (Product::where('slug', $validated['slug'])->where('id', '!=', $product->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified product
     */
    public function destroy(Product $product)
    {
        $this->authorizeProduct($product);

        // Get gallery images using the safe accessor
        $galleryImages = $product->gallery_images_array;
            
        if (!empty($galleryImages)) {
            foreach ($galleryImages as $image) {
                // Only delete if it's a local path (not a URL)
                if (is_string($image) && !str_starts_with($image, 'http')) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }

    /**
     * Toggle product status
     */
    public function toggleStatus(Product $product)
    {
        $this->authorizeProduct($product);

        $product->update([
            'status' => $product->status === 'published' ? 'draft' : 'published'
        ]);

        return back()->with('success', 'Status produk berhasil diubah!');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Product $product)
    {
        $this->authorizeProduct($product);

        $product->update([
            'is_featured' => !$product->is_featured
        ]);

        return back()->with('success', 'Status unggulan berhasil diubah!');
    }

    /**
     * Check if user is authorized to access product
     */
    private function authorizeProduct(Product $product): void
    {
        $user = Auth::user();
        
        if (!$user->isSuperAdmin() && $product->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke produk ini.');
        }
    }
}
