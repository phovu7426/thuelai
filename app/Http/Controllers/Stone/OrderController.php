<?php

namespace App\Http\Controllers\Stone;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the user's orders.
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('stone.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->findOrFail($id);
            
        return view('stone.orders.show', compact('order'));
    }

    /**
     * Cancel an order (only if it's still pending).
     */
    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        
        // Ensure the user can only cancel their own orders
        if (Auth::id() != $order->user_id) {
            abort(403);
        }
        
        // Only pending orders can be cancelled
        if ($order->status !== 'pending') {
            return redirect()->back()->with('error', 'Chỉ có thể hủy đơn hàng đang chờ duyệt.');
        }
        
        $order->update(['status' => 'cancelled']);
        return redirect()->back()->with('success', 'Đơn hàng đã được hủy thành công.');
    }
} 