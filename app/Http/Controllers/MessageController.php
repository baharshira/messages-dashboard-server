<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController
{
    // This controller implements the create message process


        // Method to return messages for the authenticated user
        public function index()
        {
            // Retrieve messages for the authenticated user
            $user = auth()->user();
            $messages = $user->messages()->get();
    
            // Return messages as a JSON response
            return response()->json($messages);
        }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'message_title' => 'required|string|max:255',
            'message_body' => 'required|string',
        ]);
    
        $user = Auth::user(); // Get the currently authenticated user
    
        // Ensure we have an authenticated user
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        $message = new Messages([
            'message_title' => $validatedData['message_title'],
            'message_body' => $validatedData['message_body'],
            'user_id' => $user->id, // Set the user_id from the authenticated user
        ]);
    
        $message->save();
    
        return response()->json($message, 201);
    }
    
}
