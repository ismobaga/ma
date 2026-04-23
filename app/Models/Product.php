<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'sku', 'short_description', 'description',
        'price', 'compare_price', 'category_id', 'collection_id',
        'stock_status', 'is_featured', 'is_new', 'is_active',
        'origin_note', 'main_image', 'whatsapp_message',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function getWhatsappUrlAttribute(): string
    {
        $phone = setting('whatsapp_number', '22300000000');
        $message = $this->whatsapp_message
            ?: "Bonjour, je suis intéressé(e) par le produit : {$this->name}";

        return 'https://wa.me/'.$phone.'?text='.urlencode($message);
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format((float) $this->price, 0, ',', ' ').' FCFA';
    }
}
