<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Analytics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get user's products or all products for super admin
        $productsQuery = $user->isSuperAdmin() 
            ? Product::query() 
            : Product::where('user_id', $user->id);

        $stats = [
            'total_products' => $productsQuery->count(),
            'published_products' => (clone $productsQuery)->published()->count(),
            'draft_products' => (clone $productsQuery)->where('status', 'draft')->count(),
            'total_views' => (clone $productsQuery)->sum('views_count'),
            'total_demo_clicks' => (clone $productsQuery)->sum('demo_clicks'),
            'total_whatsapp_clicks' => (clone $productsQuery)->sum('whatsapp_clicks'),
        ];

        // Get recent products
        $recentProducts = (clone $productsQuery)->with('category')
            ->latest()
            ->take(5)
            ->get();

        // Get top performing products
        $topProducts = (clone $productsQuery)->with('category')
            ->orderByDesc('views_count')
            ->take(5)
            ->get();

        // Analytics for chart (last 7 days)
        $analyticsData = $this->getAnalyticsChartData($user);

        return view('admin.dashboard', compact('stats', 'recentProducts', 'topProducts', 'analyticsData'));
    }

    /**
     * Get analytics data for chart
     */
    private function getAnalyticsChartData($user): array
    {
        $days = 7;
        $labels = [];
        $views = [];
        $demoClicks = [];
        $whatsappClicks = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('d M');

            $query = Analytics::whereDate('created_at', $date->toDateString());
            
            if (!$user->isSuperAdmin()) {
                $productIds = Product::where('user_id', $user->id)->pluck('id');
                $query->whereIn('product_id', $productIds);
            }

            $views[] = (clone $query)->where('event_type', 'view')->count();
            $demoClicks[] = (clone $query)->where('event_type', 'demo_click')->count();
            $whatsappClicks[] = (clone $query)->where('event_type', 'whatsapp_click')->count();
        }

        return [
            'labels' => $labels,
            'views' => $views,
            'demoClicks' => $demoClicks,
            'whatsappClicks' => $whatsappClicks,
        ];
    }
}
