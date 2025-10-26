<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OItemJoinController extends Controller
{
    public function index()
    {
        $orderItems = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.product_id')
            ->select(
                'order_items.order_item_id',
                'orders.order_name',
                'products.product_name',
                'order_items.quantity',
                'order_items.unit_price'
            )
            ->get();

        return response()->json($orderItems);
    }
}
