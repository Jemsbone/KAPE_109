<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MainDishController extends Controller
{
    /**
     * Display main dish products page
     */
    public function index()
    {
        // Fetch all main dish products from database (including out-of-stock items)
        $products = Product::where('product_category', 'main-dish')
            ->orderBy('product_name', 'asc')
            ->get();
        
        return view('Customer.CMainDish', compact('products'));
    }
}