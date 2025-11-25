<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CMenuController extends Controller
{
    /**
     * Display the customer menu with all products
     */
    public function index()
    {
        // Fetch all products from database (all categories, including out-of-stock items)
        $products = Product::orderBy('product_category', 'asc')
            ->orderBy('product_name', 'asc')
            ->get();
        
        return view('Customer.CMenu', compact('products'));
    }
}