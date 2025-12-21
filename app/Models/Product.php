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
        'main_image',
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
     * Get gallery images array (handles double-encoded JSON)
     */
    public function getGalleryImagesArrayAttribute(): array
    {
        $images = $this->attributes['gallery_images'] ?? null;
        
        if (!$images) {
            return [];
        }
        
        // If it's already an array, return it
        if (is_array($images)) {
            return $images;
        }
        
        // Try to decode JSON
        $decoded = json_decode($images, true);
        
        // If still a string (double-encoded), decode again
        if (is_string($decoded)) {
            $decoded = json_decode($decoded, true);
        }
        
        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Get main image URL (uses dedicated main_image field or falls back to first gallery image)
     */
    public function getMainImageUrlAttribute(): string
    {
        // Check if main_image exists
        if (!empty($this->main_image)) {
            // Check if it's a URL or a path
            if (str_starts_with($this->main_image, 'http')) {
                return $this->main_image;
            }
            return asset('storage/' . $this->main_image);
        }

        // Fallback to first gallery image
        $images = $this->gallery_images_array;
        
        if (count($images) > 0) {
            $firstImage = $images[0];
            // Check if it's a URL or a path
            if (str_starts_with($firstImage, 'http')) {
                return $firstImage;
            }
            return asset('storage/' . $firstImage);
        }

        // Final fallback to placeholder
        return 'https://placehold.co/600x400/1e40af/ffffff?text=' . urlencode($this->name ?? 'Product');
    }

    /**
     * Get gallery image URLs
     */
    public function getGalleryUrlsAttribute(): array
    {
        $images = $this->gallery_images_array;
        
        if (empty($images)) {
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
            // Check if it's already a URL
            if (str_starts_with($image, 'http')) {
                return $image;
            }
            return asset('storage/' . $image);
        }, $images);
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
