<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HeroSlide;
use App\Models\Product;
use App\Models\PromoBanner;
use App\Models\Analytics;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage
     */
    public function index()
    {
        $heroSlides = HeroSlide::active()->ordered()->get();
        $topBanners = PromoBanner::active()->position('top')->ordered()->get();
        $middleBanners = PromoBanner::active()->position('middle')->ordered()->get();
        $bottomBanners = PromoBanner::active()->position('bottom')->ordered()->get();
        $categories = Category::active()->ordered()->withCount(['products' => function ($query) {
            $query->published();
        }])->get();
        $featuredProducts = Product::published()->featured()->with('category')->latest()->take(8)->get();
        $latestProducts = Product::published()->with('category')->latest()->take(8)->get();

        // Calculate total visitors from all CTA actions
        $totalVisitors = Analytics::whereIn('event_type', ['view', 'demo_click', 'whatsapp_click'])->count();

        return view('public.home', compact(
            'heroSlides',
            'topBanners',
            'middleBanners',
            'bottomBanners',
            'categories',
            'featuredProducts',
            'latestProducts',
            'totalVisitors'
        ));
    }

    /**
     * Display catalog page
     */
    public function catalog(Request $request)
    {
        $query = Product::published()->with('category');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('categories')) {
            $categoryIds = is_array($request->categories) 
                ? $request->categories 
                : explode(',', $request->categories);
            $query->whereIn('category_id', $categoryIds);
        }

        // Price type filter
        if ($request->filled('price_type')) {
            $query->where('price_type', $request->price_type);
        }

        // Price range filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        $query = match($sort) {
            'price_low' => $query->orderBy('price', 'asc'),
            'price_high' => $query->orderBy('price', 'desc'),
            'popular' => $query->orderBy('views_count', 'desc'),
            'name' => $query->orderBy('name', 'asc'),
            default => $query->latest(),
        };

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::active()->ordered()->get();

        return view('public.catalog', compact('products', 'categories'));
    }

    /**
     * Display product detail page
     */
    public function productDetail(string $slug)
    {
        $product = Product::published()
            ->where('slug', $slug)
            ->with(['category', 'user'])
            ->firstOrFail();

        // Record view analytics
        Analytics::recordView($product);

        // Get related products
        $relatedProducts = Product::published()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('public.product-detail', compact('product', 'relatedProducts'));
    }

    /**
     * Track demo click
     */
    public function trackDemoClick(Product $product)
    {
        Analytics::recordDemoClick($product);
        
        return response()->json(['success' => true]);
    }

    /**
     * Track WhatsApp click
     */
    public function trackWhatsappClick(Product $product)
    {
        Analytics::recordWhatsappClick($product);
        
        return response()->json(['success' => true]);
    }

    /**
     * About page
     */
    public function about()
    {
        return view('public.about');
    }
}
