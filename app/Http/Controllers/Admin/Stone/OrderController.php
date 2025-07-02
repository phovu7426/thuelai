<?php

namespace App\Http\Controllers\Admin\Stone;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\StoneProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.stone.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $users = User::all();
        
        // Lấy tất cả sản phẩm 
        $products = StoneProduct::select('id', 'name', 'code', 'price', 'status')
            ->orderBy('name')
            ->get();
            
        // Nếu không có sản phẩm, thêm dữ liệu mẫu cho demo
        if ($products->isEmpty()) {
            $dummyProducts = collect([
                (object)[
                    'id' => 1,
                    'name' => 'Đá Granite Đen Huế',
                    'code' => 'GR001',
                    'price' => 1500000,
                    'status' => true
                ],
                (object)[
                    'id' => 2,
                    'name' => 'Đá Marble Trắng Ý',
                    'code' => 'MB001',
                    'price' => 2800000,
                    'status' => true
                ],
                (object)[
                    'id' => 3,
                    'name' => 'Đá Granite Trắng Suối Lau',
                    'code' => 'GR002',
                    'price' => 1800000,
                    'status' => true
                ],
            ]);
            
            $products = $dummyProducts;
        }
        
        return view('admin.stone.orders.create', compact('users', 'products'));
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'note' => 'nullable|string',
            'status' => 'required|in:' . implode(',', array_keys(Order::getStatuses())),
            'products' => 'required|array',
            'products.*.id' => 'required|exists:stone_products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();
            
            // Create order
            $order = new Order();
            $order->user_id = $request->user_id;
            $order->customer_name = $request->customer_name;
            $order->customer_email = $request->customer_email;
            $order->customer_phone = $request->customer_phone;
            $order->customer_address = $request->customer_address;
            $order->note = $request->note;
            $order->status = $request->status;
            $order->is_admin_created = true;
            $order->order_number = Order::generateOrderNumber();
            
            // Calculate total amount from products
            $totalAmount = 0;
            
            // Create order items and calculate total
            if (isset($request->products) && is_array($request->products)) {
                foreach ($request->products as $key => $productData) {
                    if (!empty($productData['id'])) {
                        $product = StoneProduct::findOrFail($productData['id']);
                        $quantity = intval($productData['quantity']);
                        $price = $product->price;
                        
                        $totalAmount += $price * $quantity;
                    }
                }
            }
            
            // Set total amount
            $order->total_amount = $totalAmount;
            
            // Save order first to get ID
            $order->save();
            
            // Create order items
            if (isset($request->products) && is_array($request->products)) {
                foreach ($request->products as $key => $productData) {
                    if (!empty($productData['id'])) {
                        $product = StoneProduct::findOrFail($productData['id']);
                        $quantity = intval($productData['quantity']);
                        $price = $product->price;
                        
                        $orderItem = new OrderItem();
                        $orderItem->order_id = $order->id;
                        $orderItem->stone_product_id = $product->id;
                        $orderItem->quantity = $quantity;
                        $orderItem->price = $price;
                        $orderItem->save();
                    }
                }
            }
            
            DB::commit();
            
            return redirect()->route('admin.stone.orders.index')
                ->with('success', 'Đơn hàng đã được tạo thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified order.
     */
    public function show($id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);
        return view('admin.stone.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit($id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);
        $users = User::all();
        $products = StoneProduct::all();
        
        return view('admin.stone.orders.edit', compact('order', 'users', 'products'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'note' => 'nullable|string',
            'status' => 'required|in:' . implode(',', array_keys(Order::getStatuses())),
        ]);

        $order = Order::findOrFail($id);
        
        // Kiểm tra trạng thái mới có hợp lệ không
        if ($order->status !== $request->status && !$order->canTransitionTo($request->status)) {
            return redirect()->back()
                ->with('error', 'Không thể chuyển trạng thái đơn hàng từ ' . 
                    Order::getStatuses()[$order->status] . ' sang ' . 
                    Order::getStatuses()[$request->status])
                ->withInput();
        }
        
        // Update order details
        $order->user_id = $request->user_id;
        $order->customer_name = $request->customer_name;
        $order->customer_email = $request->customer_email;
        $order->customer_phone = $request->customer_phone;
        $order->customer_address = $request->customer_address;
        $order->note = $request->note;
        $order->status = $request->status;
        $order->save();
        
        return redirect()->route('admin.stone.orders.index')
            ->with('success', 'Đơn hàng đã được cập nhật thành công.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            $order = Order::findOrFail($id);
            
            // Delete order items first
            $order->items()->delete();
            
            // Delete order
            $order->delete();
            
            DB::commit();
            
            return redirect()->route('admin.stone.orders.index')
                ->with('success', 'Đơn hàng đã được xóa thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
        }
    }
} 