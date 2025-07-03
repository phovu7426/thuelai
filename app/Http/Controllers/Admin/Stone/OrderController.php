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
    public function index(Request $request)
    {
        $query = Order::with('user');
        if ($request->filled('order_number')) {
            $query->where('order_number', 'like', '%' . $request->order_number . '%');
        }
        if ($request->filled('customer_name')) {
            $query->where('customer_name', 'like', '%' . $request->customer_name . '%');
        }
        if ($request->filled('customer_phone')) {
            $query->where('customer_phone', 'like', '%' . $request->customer_phone . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $orders = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->all());
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

            // Đảm bảo status là một chuỗi hợp lệ từ các hằng số đã định nghĩa
            switch ($request->status) {
                case 'pending':
                case Order::STATUS_PENDING:
                    $order->status = Order::STATUS_PENDING;
                    break;
                case 'processing':
                case Order::STATUS_PROCESSING:
                    $order->status = Order::STATUS_PROCESSING;
                    break;
                case 'completed':
                case Order::STATUS_COMPLETED:
                    $order->status = Order::STATUS_COMPLETED;
                    break;
                case 'cancelled':
                case Order::STATUS_CANCELLED:
                    $order->status = Order::STATUS_CANCELLED;
                    break;
                default:
                    $order->status = Order::STATUS_PENDING; // Mặc định là pending
            }

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
                        $orderItem->product_name = $product->name;
                        $orderItem->quantity = $quantity;
                        $orderItem->price = $price;
                        $orderItem->total = $price * $quantity;
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
        try {
            $order = Order::with(['items.product', 'user'])->findOrFail($id);

            // Đảm bảo tất cả các items đều có subtotal
            foreach ($order->items as $item) {
                if (!isset($item->subtotal)) {
                    $item->subtotal = $item->price * $item->quantity;
                }
            }

            return view('admin.stone.orders.show', compact('order'));
        } catch (\Exception $e) {
            return redirect()->route('admin.stone.orders.index')
                ->with('error', 'Không thể hiển thị chi tiết đơn hàng: ' . $e->getMessage());
        }
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
        // Validate dữ liệu đầu vào
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'note' => 'nullable|string',
            'status' => 'required|in:' . implode(',', array_keys(Order::getStatuses())),
        ]);

        try {
            DB::beginTransaction();

            $order = Order::findOrFail($id);
            $oldStatus = $order->status;

            // Kiểm tra trạng thái mới có hợp lệ không
            if ($oldStatus !== $request->status && !$order->canTransitionTo($request->status)) {
                DB::rollBack();
                return redirect()->back()
                    ->with('error', 'Không thể chuyển trạng thái đơn hàng từ ' .
                        Order::getStatuses()[$oldStatus] . ' sang ' .
                        Order::getStatuses()[$request->status])
                    ->withInput();
            }

            // Sử dụng raw SQL query để cập nhật
            DB::update('
                UPDATE orders 
                SET 
                    user_id = ?, 
                    customer_name = ?, 
                    customer_email = ?, 
                    customer_phone = ?, 
                    customer_address = ?, 
                    note = ?, 
                    status = ?, 
                    updated_at = ?
                WHERE id = ?
            ', [
                $request->user_id,
                $request->customer_name,
                $request->customer_email,
                $request->customer_phone,
                $request->customer_address,
                $request->note,
                $request->status,
                now(),
                $id
            ]);

            DB::commit();

            $statusMessage = '';
            switch ($request->status) {
                case Order::STATUS_PROCESSING:
                    $statusMessage = 'Đơn hàng đã được chuyển sang trạng thái đang xử lý';
                    break;
                case Order::STATUS_COMPLETED:
                    $statusMessage = 'Đơn hàng đã được đánh dấu hoàn thành';
                    break;
                case Order::STATUS_CANCELLED:
                    $statusMessage = 'Đơn hàng đã bị hủy';
                    break;
                default:
                    $statusMessage = 'Đơn hàng đã được cập nhật thành công';
            }

            return redirect()->route('admin.stone.orders.show', $order->id)
                ->with('success', $statusMessage);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage())
                ->withInput();
        }
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

    /**
     * Update the order status via AJAX request.
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);
            $newStatus = $request->input('status');

            // Validate the new status
            if (!in_array($newStatus, array_keys(Order::getStatuses()))) {
                return response()->json([
                    'success' => false,
                    'message' => 'Trạng thái không hợp lệ'
                ], 400);
            }

            // Check if the status transition is allowed
            if (!$order->canTransitionTo($newStatus)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không thể chuyển sang trạng thái này'
                ], 400);
            }

            // Update the status
            $order->status = $newStatus;
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật trạng thái thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }
}
