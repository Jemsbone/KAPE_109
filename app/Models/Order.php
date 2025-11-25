<?php

namespace App\Models;

/**
 * Order Model Alias
 * 
 * This is an alias for the orders model to provide
 * a more conventional naming and easier access to order data
 * for admin controllers.
 */
class Order extends orders
{
    /**
     * Accessor for id attribute
     * Maps to order_id in the database
     */
    public function getIdAttribute()
    {
        return $this->order_id;
    }

    /**
     * Accessor for payment_type attribute
     * Maps to order_payment_method in the database
     */
    public function getPaymentTypeAttribute()
    {
        return $this->order_payment_method;
    }

    /**
     * Accessor for total_price attribute
     * Maps to order_total_price in the database
     */
    public function getTotalPriceAttribute()
    {
        return $this->order_total_price;
    }

    /**
     * Accessor for status attribute
     * Maps to payment_status in the database
     */
    public function getStatusAttribute()
    {
        return $this->payment_status;
    }

    /**
     * Accessor for products attribute
     * Maps to order_name in the database
     */
    public function getProductsAttribute()
    {
        return $this->order_name;
    }

    /**
     * Mutator for status attribute
     * Maps to payment_status in the database
     */
    public function setStatusAttribute($value)
    {
        $this->attributes['payment_status'] = $value;
    }
}

