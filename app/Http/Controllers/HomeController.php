<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the home page
     */
    public function index()
    {
        // If user is logged in, redirect to customer home
        if (auth()->check()) {
            return redirect()->route('customer.home');
        }
        
        // If guest, show the regular home page
        return view('home');
    }
}