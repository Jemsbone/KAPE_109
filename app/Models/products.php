<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Products extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'product_id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_name',
        'product_category',
        'product_price',
        'product_stock',
        'product_image',
        'admin_id', // Add admin_id to fillable
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'product_price' => 'decimal:2',
        'product_stock' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // Add any sensitive fields here if needed
    ];

    /**
     * Get the admin that owns the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id', 'user_id'); // Adjust if using different admin model
    }

    /**
     * Get the product's price formatted as currency.
     *
     * @return string
     */
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->product_price, 2);
    }

    /**
     * Check if product is in stock.
     *
     * @return bool
     */
    public function getInStockAttribute()
    {
        return $this->product_stock > 0;
    }

    /**
     * Check if product is low on stock (less than 10 items).
     *
     * @return bool
     */
    public function getIsLowStockAttribute()
    {
        return $this->product_stock < 10;
    }

    /**
     * Scope a query to only include in-stock products.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInStock($query)
    {
        return $query->where('product_stock', '>', 0);
    }

    /**
     * Scope a query to only include products in a specific category.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $category
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('product_category', $category);
    }

    /**
     * Scope a query to only include low stock products.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLowStock($query)
    {
        return $query->where('product_stock', '<', 10);
    }

    /**
     * Scope a query to only include products by a specific admin.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $adminId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByAdmin($query, $adminId)
    {
        return $query->where('admin_id', $adminId);
    }
}