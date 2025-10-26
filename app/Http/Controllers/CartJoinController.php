<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartJoinController extends Controller
{
    public function index()
    {
        $cartData = DB::table('cart')
            ->join('users', 'cart.user_id', '=', 'users.user_id')
            ->join('products', 'cart.product_id', '=', 'products.product_id')
            ->select(
                'cart.cart_id',
                'users.name as user_name',
                'products.product_name',
                'cart.cart_name',
                'cart.quantity',
            )
            ->get();

        // return as JSON (for testing)
        return response()->json($cartData);
    }
}
