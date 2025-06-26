<?php

namespace App\Http\Controllers\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneProduct;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    /**
     * Display the shopping cart
     */
    public function index()
    {
        $cartItems = Cart::getContent();
        $cartTotal = $this->getFormattedCartTotal();
        return view('stone.cart.index', compact('cartItems', 'cartTotal'));
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
     * Add item to cart
     */
    public function add(Request $request)
    {
        \Log::info('Add to cart request:', $request->all());
        
        $product = StoneProduct::findOrFail($request->product_id);
        \Log::info('Product found:', $product->toArray());
        
        try {
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity ?? 1,
                'attributes' => [
                    'image' => $product->main_image
                ],
                'associatedModel' => $product
            ]);
            
            \Log::info('Cart after add:', Cart::getContent()->toArray());
            
            session()->flash('success', 'Sản phẩm "' . $product->name . '" đã được thêm vào giỏ hàng.');
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error('Error adding to cart: ' . $e->getMessage());
            session()->flash('error', 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng.');
            return redirect()->back();
        }
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request)
    {
        Cart::update($request->id, [
            'quantity' => [
                'relative' => false,
                'value' => $request->quantity
            ]
        ]);

        return redirect()->route('stone.cart.index')->with('success', 'Giỏ hàng đã được cập nhật.');
    }

    /**
     * Remove item from cart
     */
    public function remove(Request $request)
    {
        Cart::remove($request->id);
        return redirect()->route('stone.cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }

    /**
     * Clear all items from cart
     */
    public function clear()
    {
        Cart::clear();
        return redirect()->route('stone.cart.index')->with('success', 'Giỏ hàng đã được làm trống.');
    }
} 