<?php

namespace App\Http\Controllers\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneContact;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Hiển thị trang liên hệ
     */
    public function index()
    {
        $contactInfo = ContactInfo::first();
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

        StoneContact::create($request->all());

        return redirect()->route('stone.contact.index')
            ->with('success', 'Cảm ơn bạn đã liên hệ với chúng tôi. Chúng tôi sẽ phản hồi trong thời gian sớm nhất!');
    }
} 