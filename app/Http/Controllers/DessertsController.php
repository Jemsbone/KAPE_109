<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DessertsController extends Controller
{
    /**
     * Display desserts products page
     */
    public function index()
    {
        return view('Customer.CDesserts');
    }
}