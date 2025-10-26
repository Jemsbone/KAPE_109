<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coffee_shop_employee extends Model
{
    use HasFactory;

    protected $table = 'coffee_shop_employee';
    protected $primaryKey = 'employee_id';
    
    protected $fillable = [
        'admin_id',
        'employee_name',
        'employee_age',
        'employee_sex',
        'employee_phone',
        'employee_email',
        'employee_address',
        'employee_password',
    ];

    protected $hidden = [
        'employee_password', 
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Employee belongs to one admin
    public function admin()
    {
        return $this->belongsTo(coffee_shop_admin::class, 'admin_id', 'admin_id');
    }

    // Employee has many orders
    public function orders() // ADD THIS METHOD
    {
        return $this->hasMany(orders::class, 'employee_id', 'employee_id');
    }

    public function getAuthPassword()
    {
        return $this->employee_password;
    }
}