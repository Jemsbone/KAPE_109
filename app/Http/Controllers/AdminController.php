<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\coffee_shop_admin;

class AdminController extends Controller
{

    public function getAlladmin(){
        $admin = coffee_shop_admin::all();
        return response()->json($admin);
    }
}