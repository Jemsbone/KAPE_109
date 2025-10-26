<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_items extends Model
{
    // Table name
    protected $table = 'order_items';

    // Primary key
    protected $primaryKey = 'order_item_id';

    // Mass assignable attributes
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'quantity',
        'unit_price',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];


    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
