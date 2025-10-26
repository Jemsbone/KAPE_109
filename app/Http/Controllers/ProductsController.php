<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\products;

class ProductsController extends Controller
{
    public function getAllproducts(){
        $products = products::all();
        return response()->json($products);
    }
}
