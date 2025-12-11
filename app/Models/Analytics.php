<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Analytics extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'event_type',
        'ip_address',
        'user_agent',
        'referer',
    ];

    /**
     * Get the product for this analytics entry
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Record a product view
     */
    public static function recordView(Product $product): void
    {
        static::create([
            'product_id' => $product->id,
            'event_type' => 'view',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'referer' => request()->headers->get('referer'),
        ]);

        $product->incrementViews();
    }

    /**
     * Record a demo click
     */
    public static function recordDemoClick(Product $product): void
    {
        static::create([
            'product_id' => $product->id,
            'event_type' => 'demo_click',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'referer' => request()->headers->get('referer'),
        ]);

        $product->incrementDemoClicks();
    }

    /**
     * Record a WhatsApp click
     */
    public static function recordWhatsappClick(Product $product): void
    {
        static::create([
            'product_id' => $product->id,
            'event_type' => 'whatsapp_click',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'referer' => request()->headers->get('referer'),
        ]);

        $product->incrementWhatsappClicks();
    }

    /**
     * Scope by event type
     */
    public function scopeEventType($query, string $type)
    {
        return $query->where('event_type', $type);
    }

    /**
     * Scope by date range
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }
}
