<?php

namespace App\Models;

/**
 * Employee Model Alias
 * 
 * This is an alias for the coffee_shop_employee model to provide
 * a more conventional naming and easier access to employee data
 * for admin controllers.
 */
class Employee extends coffee_shop_employee
{
    // No need to override anything - just use parent class directly
    // The coffee_shop_employee model already has the correct table and primary key
}

