<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Fetch messages for a buyer (user).
     */
    public function fetchMessages(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized access.'], 403);
        }

        $messages = Message::where('order_id', $order->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'messages' => $messages,
            'current_user_id' => Auth::id(),
            'current_user_type' => 'user'
        ]);
    }

    /**
     * Send a message from a buyer (user).
     */
    public function sendMessage(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized access.'], 403);
        }

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'order_id' => $order->id,
            'sender_id' => Auth::id(),
            'sender_type' => 'user',
            'message' => $request->message,
            'is_read' => false,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => $message
        ]);
    }

    /**
     * Fetch messages for a seller.
     */
    public function fetchMessagesSeller(Order $order)
    {
        $sellerId = Auth::guard('seller')->id();
        if ($order->seller_id !== $sellerId) {
            return response()->json(['error' => 'Unauthorized access.'], 403);
        }

        $messages = Message::where('order_id', $order->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'messages' => $messages,
            'current_user_id' => $sellerId,
            'current_user_type' => 'seller'
        ]);
    }

    /**
     * Send a message from a seller.
     */
    public function sendMessageSeller(Request $request, Order $order)
    {
        $sellerId = Auth::guard('seller')->id();
        if ($order->seller_id !== $sellerId) {
            return response()->json(['error' => 'Unauthorized access.'], 403);
        }

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'order_id' => $order->id,
            'sender_id' => $sellerId,
            'sender_type' => 'seller',
            'message' => $request->message,
            'is_read' => false,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => $message
        ]);
    }
}
