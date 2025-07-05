<?php

namespace App\Http\Controllers\Admin\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneProduct;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Hiển thị danh sách tồn kho
     */
    public function index(Request $request)
    {
        $query = StoneProduct::with(['category', 'material']);

        // Lọc theo tên sản phẩm
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Lọc theo mã sản phẩm
        if ($request->filled('code')) {
            $query->where('code', 'like', '%' . $request->code . '%');
        }

        // Lọc theo số lượng
        if ($request->filled('quantity_from')) {
            $query->where('quantity', '>=', $request->quantity_from);
        }
        if ($request->filled('quantity_to')) {
            $query->where('quantity', '<=', $request->quantity_to);
        }

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $products = $query->orderBy('quantity', 'asc')
            ->paginate(10)
            ->appends($request->all());

        return view('admin.stone.inventory.index', compact('products'));
    }

    /**
     * Cập nhật số lượng tồn kho
     */
    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
            'note' => 'nullable|string|max:255'
        ]);

        $product = StoneProduct::findOrFail($id);
        $oldQuantity = $product->quantity;
        $newQuantity = $request->quantity;
        $difference = $newQuantity - $oldQuantity;

        $product->quantity = $newQuantity;
        $product->save();

        // Có thể thêm log để ghi lại lịch sử thay đổi số lượng
        // StockHistory::create([...]);

        return redirect()->back()->with('success', 
            'Đã cập nhật số lượng sản phẩm "' . $product->name . '" từ ' . 
            $oldQuantity . ' thành ' . $newQuantity . 
            ($request->note ? ' (Ghi chú: ' . $request->note . ')' : '')
        );
    }
} 