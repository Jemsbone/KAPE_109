<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

/**
 * Employee Controller
 * 
 * Manages employee operations for admin panel including:
 * - Viewing all employees
 * - Creating new employees
 * - Deleting employees
 */
class EmployeeController extends Controller
{
    /**
     * Display a listing of all employees
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            // Fetch all employees ordered by employee_id
            $employees = Employee::orderBy('employee_id', 'asc')->get();
            
            return view('Admin.Admin_employee', compact('employees'));
        } catch (\Exception $e) {
            Log::error('Error fetching employees: ' . $e->getMessage());
            
            return view('Admin.Admin_employee', [
                'employees' => [],
                'error' => 'Unable to fetch employees. Please try again later.'
            ]);
        }
    }

    /**
     * Show the form for creating a new employee
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('Admin.admin_create_employee');
    }

    /**
     * Store a newly created employee in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:50', 'unique:coffee_shop_employee,employee_name'],
                'age' => ['required', 'integer', 'min:18', 'max:100'],
                'sex' => ['required', 'string', 'in:Male,Female,Other'],
                'email' => ['required', 'email', 'max:50', 'unique:coffee_shop_employee,employee_email'],
                'phone' => ['required', 'string', 'max:50'],
                'address' => ['required', 'string', 'max:50'],
                'password' => ['required', 'confirmed', Password::min(6)],
            ]);

            // Create the employee using actual database column names
            $employee = new Employee();
            $employee->employee_name = $validated['name'];
            $employee->employee_age = $validated['age'];
            $employee->employee_sex = $validated['sex'];
            $employee->employee_email = $validated['email'];
            $employee->employee_phone = $validated['phone'];
            $employee->employee_address = $validated['address'];
            $employee->employee_password = Hash::make($validated['password']);
            $employee->save();

            return redirect()->route('admin.employees')
                ->with('success', 'Employee registered successfully!');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
                
        } catch (\Exception $e) {
            Log::error('Error creating employee: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Failed to register employee. Please try again.')
                ->withInput();
        }
    }

    /**
     * Remove the specified employee from storage
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Find and delete the employee
            $employee = Employee::findOrFail($id);
            $employee->delete();

            return redirect()->route('admin.employees')
                ->with('success', 'Employee deleted successfully!');
                
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.employees')
                ->with('error', 'Employee not found.');
                
        } catch (\Exception $e) {
            Log::error('Error deleting employee: ' . $e->getMessage());
            
            return redirect()->route('admin.employees')
                ->with('error', 'Failed to delete employee. Please try again.');
        }
    }
}

