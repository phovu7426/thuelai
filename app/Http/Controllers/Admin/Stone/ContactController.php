<?php

namespace App\Http\Controllers\Admin\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneContact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Hiển thị danh sách liên hệ
     */
    public function index()
    {
        $contacts = StoneContact::orderBy('created_at', 'desc')->paginate(10);
        $unreadCount = StoneContact::where('is_read', false)->count();
        
        return view('admin.stone.contacts.index', compact('contacts', 'unreadCount'));
    }

    /**
     * Hiển thị chi tiết liên hệ
     */
    public function show($id)
    {
        $contact = StoneContact::findOrFail($id);
        
        // Đánh dấu là đã đọc nếu chưa đọc
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }
        
        return view('admin.stone.contacts.show', compact('contact'));
    }

    /**
     * Xóa liên hệ
     */
    public function destroy($id)
    {
        $contact = StoneContact::findOrFail($id);
        $contact->delete();
        
        return redirect()->route('admin.stone.contacts.index')
            ->with('success', 'Xóa liên hệ thành công');
    }
    
    /**
     * Đánh dấu nhiều liên hệ là đã đọc
     */
    public function markAsRead(Request $request)
    {
        $ids = $request->ids;
        
        StoneContact::whereIn('id', $ids)->update(['is_read' => true]);
        
        return response()->json(['success' => true]);
    }
    
    /**
     * Xóa nhiều liên hệ
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        
        StoneContact::whereIn('id', $ids)->delete();
        
        return response()->json(['success' => true]);
    }
} 