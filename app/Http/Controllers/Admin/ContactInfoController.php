<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ContactInfoController extends Controller
{
    public function edit()
    {
        $contact = null;
        if (Schema::hasTable('contact_infos')) {
            $contact = ContactInfo::first();
        }
        return view('admin.contact_info.edit', compact('contact'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'working_time' => 'nullable|string',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'youtube' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'map_embed' => 'nullable|string',
        ]);
        $contact = null;
        if (Schema::hasTable('contact_infos')) {
            $contact = ContactInfo::first();
        }
        if (!$contact) {
            $contact = ContactInfo::create($data);
        } else {
            $contact->update($data);
        }
        return redirect()->route('admin.contact-info.edit')->with('success', 'Cập nhật thông tin liên hệ thành công!');
    }
}
