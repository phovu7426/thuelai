<?php

namespace App\Http\Controllers\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneContact;
use App\Models\ContactInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ContactController extends Controller
{
    /**
     * Hiển thị trang liên hệ
     */
    public function index()
    {
        $contactInfo = null;
        if (Schema::hasTable('contact_infos')) {
            $contactInfo = ContactInfo::first();
        }
        return view('stone.contact', compact('contactInfo'));
    }

    /**
     * Lưu thông tin liên hệ
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $contactData = $request->only(['name', 'email', 'phone', 'subject', 'message']);
        $contact = StoneContact::create($contactData);
        $contactData['id'] = $contact->id; // Thêm id vào contactData

        // Lấy email admin từ cấu hình
        $adminEmail = null;
        if (Schema::hasTable('contact_infos')) {
            $contactInfo = ContactInfo::first();
            $adminEmail = $contactInfo?->email;
        }
        if ($adminEmail) {
            try {
                \App\Jobs\SendContactNotification::dispatch($adminEmail, $contactData);
                // $contact->update(['mail_sent' => true]); // Xóa dòng này, cập nhật trong job
            } catch (\Throwable $e) {
                // Có thể log lỗi nếu cần
            }
        }

        return redirect()->route('stone.contact.index')
            ->with('success', 'Cảm ơn bạn đã liên hệ với chúng tôi. Chúng tôi sẽ phản hồi trong thời gian sớm nhất!');
    }
}
