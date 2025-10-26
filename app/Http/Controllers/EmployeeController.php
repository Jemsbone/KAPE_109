<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\coffee_shop_employee;

class EmployeeController extends Controller
{
        public function getAllemployee(){
        $employee = coffee_shop_employee::all();
        return response()->json($employee);
    }
}
