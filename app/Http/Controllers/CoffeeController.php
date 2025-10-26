<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoffeeController extends Controller
{
    /**
     * Display coffee products page
     */
    public function index()
    {
        return view('Customer.CCoffee');
    }
}