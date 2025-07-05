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
        
        $quantity = $request->quantity ?? 1;
        
        // Kiểm tra số lượng trong kho
        if ($product->quantity < $quantity) {
            session()->flash('error', 'Số lượng sản phẩm trong kho không đủ. Hiện chỉ còn ' . $product->quantity . ' sản phẩm.');
            return redirect()->back();
        }
        
        // Kiểm tra số lượng trong giỏ hàng hiện tại
        $cartItem = Cart::get($product->id);
        if ($cartItem) {
            $totalQuantity = $cartItem->quantity + $quantity;
            if ($totalQuantity > $product->quantity) {
                session()->flash('error', 'Tổng số lượng sản phẩm vượt quá số lượng trong kho. Hiện chỉ còn ' . $product->quantity . ' sản phẩm.');
                return redirect()->back();
            }
        }
        
        try {
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
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
        $cartItem = Cart::get($request->id);
        if (!$cartItem) {
            return redirect()->route('stone.cart.index')->with('error', 'Không tìm thấy sản phẩm trong giỏ hàng.');
        }
        
        $product = StoneProduct::find($cartItem->associatedModel->id);
        if (!$product) {
            return redirect()->route('stone.cart.index')->with('error', 'Không tìm thấy sản phẩm.');
        }
        
        // Kiểm tra số lượng trong kho
        if ($product->quantity < $request->quantity) {
            return redirect()->route('stone.cart.index')->with('error', 'Số lượng sản phẩm trong kho không đủ. Hiện chỉ còn ' . $product->quantity . ' sản phẩm.');
        }

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