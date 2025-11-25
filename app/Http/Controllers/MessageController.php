<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Store a new message from customer
     */
    public function store(Request $request)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must be logged in to send a message.');
        }

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'msg' => 'required|string|max:500',
        ]);

        // Create the message
        Message::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->msg,
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully! We will respond to you soon.');
    }

    /**
     * Display all messages for admin
     */
    public function index()
    {
        // Get all messages ordered by newest first
        $messages = Message::with('user')
            ->orderBy('is_read', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Admin.admin_message', compact('messages'));
    }

    /**
     * Mark a message as read
     */
    public function markAsRead($id)
    {
        $message = Message::findOrFail($id);
        $message->is_read = true;
        $message->save();

        return redirect()->back()->with('success', 'Message marked as read.');
    }

    /**
     * Delete a message
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->back()->with('success', 'Message deleted successfully.');
    }

    /**
     * Get unread message count
     */
    public function getUnreadCount()
    {
        return Message::where('is_read', false)->count();
    }
}

