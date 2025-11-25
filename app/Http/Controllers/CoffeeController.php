<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CoffeeController extends Controller
{
    /**
     * Display coffee products page
     */
    public function index()
    {
        // Fetch all coffee products from database (including out-of-stock items)
        $products = Product::where('product_category', 'coffee')
            ->orderBy('product_name', 'asc')
            ->get();
        
        return view('Customer.CCoffee', compact('products'));
    }
}