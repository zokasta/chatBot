<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Session::get('chat_history', []);
        return view('chat.index', compact('chats'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $chat = [
            'message' => $request->message,
            'reply' => 'Yeh reply hai: ' . $request->message
        ];

        $chat_history = Session::get('chat_history', []);
        $chat_history[] = $chat;
        Session::put('chat_history', $chat_history);

        return response()->json(['success' => true, 'chat' => $chat]);
    }

    public function history()
    {
        $chats = Session::get('chat_history', []);
        return response()->json($chats);
    }
}
