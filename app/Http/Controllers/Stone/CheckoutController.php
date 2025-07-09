<?php

namespace App\Http\Controllers\Stone;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\StoneProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Cart;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page
     */
    public function index()
    {
        if (Cart::isEmpty()) {
            return redirect()->route('stone.products.index')->with('error', 'Giỏ hàng của bạn đang trống');
        }
        
        // Kiểm tra số lượng trong kho trước khi hiển thị trang thanh toán
        foreach (Cart::getContent() as $item) {
            $product = StoneProduct::find($item->id);
            if ($product && $product->quantity < $item->quantity) {
                Cart::update($item->id, [
                    'quantity' => [
                        'relative' => false,
                        'value' => $product->quantity
                    ]
                ]);
                session()->flash('warning', 'Số lượng sản phẩm "' . $product->name . '" đã được điều chỉnh do vượt quá số lượng trong kho.');
            }
        }
        
        $cartItems = Cart::getContent();
        $cartTotal = $this->getFormattedCartTotal();
        return view('stone.checkout.index', compact('cartItems', 'cartTotal'));
    }

    /**
     * Get the properly formatted cart total
     */
    private function getFormattedCartTotal()
    {
        // Calculate the total manually from cart items
        $total = 0;
        foreach (Cart::getContent() as $item) {
            $total += $item->price * $item->quantity;
        }
        
        return $total;
    }

    /**
     * Process the checkout
     */
    public function process(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'customer_email' => 'nullable|email|max:255',
            'note' => 'nullable|string',
        ]);

        if (Cart::isEmpty()) {
            return redirect()->route('stone.products.index')->with('error', 'Giỏ hàng của bạn đang trống');
        }

        try {
            DB::beginTransaction();

            // Kiểm tra số lượng trong kho trước khi tạo đơn hàng
            foreach (Cart::getContent() as $item) {
                $product = StoneProduct::find($item->id);
                if (!$product) {
                    throw new \Exception('Không tìm thấy sản phẩm trong hệ thống.');
                }
                if ($product->quantity < $item->quantity) {
                    throw new \Exception('Sản phẩm "' . $product->name . '" không đủ số lượng trong kho. Hiện chỉ còn ' . $product->quantity . ' sản phẩm.');
                }
            }

            // Create order
            $order = new Order();
            $order->user_id = Auth::id();
            $order->order_number = Order::generateOrderNumber();
            $order->customer_name = $request->customer_name;
            $order->customer_email = $request->customer_email;
            $order->customer_phone = $request->customer_phone;
            $order->customer_address = $request->customer_address;
            $order->note = $request->note;
            
            // Use the correctly calculated cart total
            $order->total_amount = $this->getFormattedCartTotal();
            
            $order->status = 'pending';
            $order->save();

            // Create order items and update product quantities
            foreach (Cart::getContent() as $item) {
                $product = StoneProduct::find($item->id);
                
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $product->id;
                $orderItem->product_name = $product->name;
                $orderItem->quantity = $item->quantity;
                $orderItem->price = $item->price;
                $orderItem->total = $item->price * $item->quantity;
                $orderItem->save();

                // Trừ số lượng trong kho
                $product->quantity -= $item->quantity;
                $product->save();
            }

            // Clear cart
            Cart::clear();

            DB::commit();

            return redirect()->route('stone.checkout.success', ['order' => $order->id])
                ->with('success', 'Đơn hàng của bạn đã được tạo thành công');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the success page
     */
    public function success($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);
        
        // Check if the order belongs to the current user
        if (Auth::check() && $order->user_id != Auth::id()) {
            abort(403);
        }
        
        return view('stone.checkout.success', compact('order'));
    }
} 