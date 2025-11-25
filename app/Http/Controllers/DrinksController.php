<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DrinksController extends Controller
{
    /**
     * Display drinks products page
     */
    public function index()
    {
        // Fetch all drink products from database (including out-of-stock items)
        $products = Product::where('product_category', 'drinks')
            ->orderBy('product_name', 'asc')
            ->get();
        
        return view('Customer.CDrinks', compact('products'));
    }
}