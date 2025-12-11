<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'slug',
        'short_description',
        'description',
        'price',
        'price_type',
        'gallery_images',
        'features',
        'demo_url',
        'demo_username',
        'demo_password',
        'owner_name',
        'owner_whatsapp',
        'meta_title',
        'meta_description',
        'status',
        'is_featured',
        'views_count',
        'demo_clicks',
        'whatsapp_clicks',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'features' => 'array',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
    ];

    /**
     * Boot function to generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
                
                // Make slug unique
                $originalSlug = $product->slug;
                $count = 1;
                while (static::where('slug', $product->slug)->exists()) {
                    $product->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });
    }

    /**
     * Get the user that owns the product
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category of the product
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get analytics for this product
     */
    public function analytics(): HasMany
    {
        return $this->hasMany(Analytics::class);
    }

    /**
     * Get main image URL (first image from gallery)
     */
    public function getMainImageUrlAttribute(): string
    {
        if (is_array($this->gallery_images) && count($this->gallery_images) > 0) {
            return asset('storage/' . $this->gallery_images[0]);
        }
        return 'https://placehold.co/600x400/1e40af/ffffff?text=' . urlencode($this->name ?? 'Product');
    }

    /**
     * Get gallery image URLs
     */
    public function getGalleryUrlsAttribute(): array
    {
        if (!$this->gallery_images || !is_array($this->gallery_images)) {
            // Return 5 placeholder images if no gallery images uploaded
            $productName = urlencode($this->name ?? 'Product');
            return [
                "https://placehold.co/800x600/1e40af/ffffff?text={$productName}+1",
                "https://placehold.co/800x600/2563eb/ffffff?text={$productName}+2",
                "https://placehold.co/800x600/3b82f6/ffffff?text={$productName}+3",
                "https://placehold.co/800x600/06b6d4/ffffff?text={$productName}+4",
                "https://placehold.co/800x600/0891b2/ffffff?text={$productName}+5",
            ];
        }
        
        return array_map(function ($image) {
            return asset('storage/' . $image);
        }, $this->gallery_images);
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute(): string
    {
        $formatted = 'Rp ' . number_format((float) $this->price ?? 0, 0, ',', '.');
        
        return match($this->price_type) {
            'monthly' => $formatted . ' / bulan',
            'yearly' => $formatted . ' / tahun',
            'one_time' => $formatted . ' (sekali bayar)',
            default => $formatted,
        };
    }

    /**
     * Get WhatsApp URL
     */
    public function getWhatsappUrlAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', $this->owner_whatsapp);
        
        // Convert 08xx to 628xx
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }
        
        $message = urlencode("Halo, saya tertarik dengan produk \"{$this->name}\" di Skanic Tech. Boleh minta informasi lebih lanjut?");
        
        return "https://wa.me/{$phone}?text={$message}";
    }

    /**
     * Get price type label
     */
    public function getPriceTypeLabelAttribute(): string
    {
        return match($this->price_type) {
            'monthly' => 'Bulanan',
            'yearly' => 'Tahunan',
            'one_time' => 'Sekali Bayar',
            default => $this->price_type,
        };
    }

    /**
     * Scope published products
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope featured products
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Increment view count
     */
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    /**
     * Increment demo click count
     */
    public function incrementDemoClicks(): void
    {
        $this->increment('demo_clicks');
    }

    /**
     * Increment WhatsApp click count
     */
    public function incrementWhatsappClicks(): void
    {
        $this->increment('whatsapp_clicks');
    }
}
