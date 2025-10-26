<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainDishController extends Controller
{
    /**
     * Display main dish products page
     */
    public function index()
    {
        return view('Customer.CMainDish');
    }
}