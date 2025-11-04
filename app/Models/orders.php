<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'employee_id',
        'order_name',
        'order_number',
        'order_payment_method',
        'order_total_price',
        'payment_status',
        'order_date',
    ];

    protected $casts = [
        'order_total_price' => 'decimal:2',
        'order_number' => 'integer',
        'order_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $attributes = [
        'payment_status' => 'pending',
    ];

    /**
     * Get the user (customer) associated with the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Get the employee associated with the order.
     */
    public function employee()
    {
        return $this->belongsTo(coffee_shop_employee::class, 'employee_id', 'employee_id');
    }

    /**
     * Get the formatted total price.
     *
     * @return string
     */
    public function getFormattedTotalPriceAttribute()
    {
        return '$' . number_format($this->order_total_price, 2);
    }

    protected $hidden = [
        'created_at',
        'updated_at'
    ];


    /**
     * Get the formatted order date.
     *
     * @return string
     */
    public function getFormattedOrderDateAttribute()
    {
        return $this->order_date->format('F j, Y g:i A');
    }

    /**
     * Check if order is paid.
     *
     * @return bool
     */
    public function getIsPaidAttribute()
    {
        return $this->payment_status === 'paid';
    }

    /**
     * Check if order is pending.
     *
     * @return bool
     */
    public function getIsPendingAttribute()
    {
        return $this->payment_status === 'pending';
    }

    /**
     * Check if order is failed or cancelled.
     *
     * @return bool
     */
    public function getIsFailedAttribute()
    {
        return in_array($this->payment_status, ['failed', 'cancelled']);
    }

    /**
     * Mark order as paid.
     *
     * @return bool
     */
    public function markAsPaid()
    {
        $this->payment_status = 'paid';
        return $this->save();
    }

    /**
     * Mark order as failed.
     *
     * @return bool
     */
    public function markAsFailed()
    {
        $this->payment_status = 'failed';
        return $this->save();
    }

    /**
     * Mark order as cancelled.
     *
     * @return bool
     */
    public function markAsCancelled()
    {
        $this->payment_status = 'cancelled';
        return $this->save();
    }

    /**
     * Scope a query to only include orders for a specific employee.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $employeeId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForEmployee($query, $employeeId)
    {
        return $query->where('employee_id', $employeeId);
    }

    /**
     * Scope a query to only include paid orders.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    /**
     * Scope a query to only include pending orders.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }

    /**
     * Scope a query to only include orders within a date range.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $startDate
     * @param  string  $endDate
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('order_date', [$startDate, $endDate]);
    }

    /**
     * Scope a query to only include orders with a specific payment method.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $paymentMethod
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePaymentMethod($query, $paymentMethod)
    {
        return $query->where('order_payment_method', $paymentMethod);
    }

    /**
     * Get all possible payment statuses.
     *
     * @return array
     */
    public static function getPaymentStatuses()
    {
        return ['pending', 'paid', 'failed', 'cancelled'];
    }

    /**
     * Get all possible payment methods.
     *
     * @return array
     */
    public static function getPaymentMethods()
    {
        return ['gcash', 'cash', 'bank_transfer'];
    }
}