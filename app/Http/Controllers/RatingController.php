<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rating;

class RatingController extends Controller
{
    public function getAllrating(){
        $rating = rating::all();
        return response()->json($rating);
    }
}
