<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'subject' => 'required|string',
        ]);

        $message = Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return response()->json(['message' => 'Message sent successfully'], 200);
    }
    public function show()
    {
        $messages = Message::all();
        return response()->json(['messages' => $messages], 200);
    }
    public function delete($id)
    {
        $message = Message::where('id', $id)->delete();
        return response()->json(['message' => 'Message deleted successfully'], 200);
    }
}
