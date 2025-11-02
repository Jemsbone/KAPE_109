<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CMenuController extends Controller
{
    /**
     * Display the customer menu
     */
    public function index()
    {
        return view('Customer.CMenu');
    }
}