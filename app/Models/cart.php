<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cart';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'cart_id';

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
        'user_id',
        'product_id',
        'cart_name',
        'quantity',
        'product_image',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];


    /**
     * Get the user that owns the cart item.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Get the product that belongs to the cart item.
     */
    public function product()
    {
        return $this->belongsTo(products::class, 'product_id', 'product_id');
    }

    /**
     * Calculate the total price for this cart item.
     *
     * @return float
     */
    public function getTotalPriceAttribute()
    {
        if ($this->product) {
            return $this->product->product_price * $this->quantity;
        }
        return 0;
    }

    /**
     * Get the formatted total price.
     *
     * @return string
     */
    public function getFormattedTotalPriceAttribute()
    {
        return '$' . number_format($this->total_price, 2);
    }

    /**
     * Scope a query to only include cart items for a specific user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope a query to only include cart items with a specific product.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $productId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForProduct($query, $productId)
    {
        return $query->where('product_id', $productId);
    }

    /**
     * Check if cart item has a product image, otherwise use product's image.
     *
     * @return string|null
     */
    public function getDisplayImageAttribute()
    {
        return $this->product_image ?? $this->product?->product_image;
    }

    /**
     * Increase the quantity of the cart item.
     *
     * @param  int  $amount
     * @return bool
     */
    public function increaseQuantity($amount = 1)
    {
        $this->quantity += $amount;
        return $this->save();
    }

    /**
     * Decrease the quantity of the cart item.
     *
     * @param  int  $amount
     * @return bool
     */
    public function decreaseQuantity($amount = 1)
    {
        $this->quantity = max(0, $this->quantity - $amount);
        return $this->save();
    }

    /**
     * Check if the cart item is for a specific user.
     *
     * @param  int  $userId
     * @return bool
     */
    public function isOwnedBy($userId)
    {
        return $this->user_id == $userId;
    }
}