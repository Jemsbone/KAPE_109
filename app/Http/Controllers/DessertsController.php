<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DessertsController extends Controller
{
    /**
     * Display desserts products page
     */
    public function index()
    {
        // Fetch all dessert products from database (including out-of-stock items)
        $products = Product::where('product_category', 'desserts')
            ->orderBy('product_name', 'asc')
            ->get();
        
        return view('Customer.CDesserts', compact('products'));
    }
}