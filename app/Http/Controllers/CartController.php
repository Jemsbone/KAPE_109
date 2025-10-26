<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cart;

class CartController extends Controller
{
   public function getAllcart(){
        $cart = cart::all();
        return response()->json($cart);
    } 
}
