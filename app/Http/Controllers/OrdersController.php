<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\orders;

class OrdersController extends Controller
{
    public function getAllorders(){
        $orders = orders::all();
        return response()->json($orders);
    }
}
