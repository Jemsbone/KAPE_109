<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order_items;

class OItemsController extends Controller
{
    public function getAlloitems(){
        $oitems = order_items::all();
        return response()->json($oitems);
    }
}
