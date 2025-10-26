<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DrinksController extends Controller
{
    /**
     * Display drinks products page
     */
    public function index()
    {
        return view('Customer.CDrinks');
    }
}