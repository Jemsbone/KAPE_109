<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

/**
 * User Controller
 * 
 * Manages user operations for admin panel including:
 * - Viewing all users
 * - Deleting users
 */
class UserController extends Controller
{
    /**
     * Display a listing of all users
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            // Fetch all users ordered by user_id
            $users = User::orderBy('user_id', 'asc')->get();
            
            return view('Admin.admin_user', compact('users'));
        } catch (\Exception $e) {
            Log::error('Error fetching users: ' . $e->getMessage());
            
            return view('Admin.admin_user', [
                'users' => [],
                'error' => 'Unable to fetch users. Please try again later.'
            ]);
        }
    }

    /**
     * Remove the specified user from storage
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $userName = $user->name;
            
            $user->delete();
            
            return redirect()->route('admin.users')
                ->with('success', "User '{$userName}' has been deleted successfully.");
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            
            return redirect()->route('admin.users')
                ->with('error', 'Unable to delete user. Please try again.');
        }
    }
}

