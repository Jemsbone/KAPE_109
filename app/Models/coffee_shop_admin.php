<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coffee_shop_admin extends Model
{
    use HasFactory;

    protected $table = 'coffee_shop_admin';
    protected $primaryKey = 'admin_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'admin_name',
        'admin_password',
    ];

    protected $hidden = [
        'admin_password',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    

    public $timestamps = true;

    // ADD THIS: Admin has many employees
    public function employees()
    {
        return $this->hasMany(coffee_shop_employee::class, 'admin_id', 'admin_id');
    }
}