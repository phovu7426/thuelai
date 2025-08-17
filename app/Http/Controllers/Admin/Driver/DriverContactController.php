<?php

namespace App\Http\Controllers\Admin\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\Driver\ContactNotification;

class DriverContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy danh sách liên hệ từ bảng contacts hoặc tạo model mới
        // Tạm thời sử dụng session để lưu trữ
        $contacts = collect(session('driver_contacts', []));
        
        return view('admin.driver.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.driver.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10|max:2000',
        ], [
            'name.required' => 'Tên là bắt buộc',
            'email.required' => 'Email là bắt buộc',
            'email.email' => 'Email không hợp lệ',
            'phone.required' => 'Số điện thoại là bắt buộc',
            'message.required' => 'Nội dung tin nhắn là bắt buộc',
            'message.min' => 'Nội dung tin nhắn phải có ít nhất 10 ký tự',
            'message.max' => 'Nội dung tin nhắn không được vượt quá 2000 ký tự',
        ]);

        try {
            // Lưu vào session tạm thời (có thể thay bằng database sau)
            $contact = [
                'id' => uniqid(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'status' => 'unread',
                'created_at' => now(),
                'admin_notes' => null,
            ];

            $contacts = collect(session('driver_contacts', []));
            $contacts->push($contact);
            session(['driver_contacts' => $contacts->toArray()]);

            // Gửi email thông báo (nếu có cấu hình email)
            try {
                // Mail::to('admin@thuelai.vn')->send(new ContactNotification($contact));
            } catch (\Exception $e) {
                // Log lỗi gửi email
                Log::error('Failed to send contact notification email: ' . $e->getMessage());
            }

            return redirect()->route('admin.driver.contacts.index')
                ->with('success', 'Liên hệ đã được tạo thành công!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Có lỗi xảy ra khi tạo liên hệ: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contacts = collect(session('driver_contacts', []));
        $contact = $contacts->firstWhere('id', $id);

        if (!$contact) {
            abort(404);
        }

        return view('admin.driver.contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $contacts = collect(session('driver_contacts', []));
        $contact = $contacts->firstWhere('id', $id);

        if (!$contact) {
            abort(404);
        }

        return view('admin.driver.contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10|max:2000',
            'status' => 'required|in:unread,read,replied,closed',
            'admin_notes' => 'nullable|string',
        ], [
            'name.required' => 'Tên là bắt buộc',
            'email.required' => 'Email là bắt buộc',
            'email.email' => 'Email không hợp lệ',
            'phone.required' => 'Số điện thoại là bắt buộc',
            'message.required' => 'Nội dung tin nhắn là bắt buộc',
            'message.min' => 'Nội dung tin nhắn phải có ít nhất 10 ký tự',
            'message.max' => 'Nội dung tin nhắn không được vượt quá 2000 ký tự',
            'status.required' => 'Trạng thái là bắt buộc',
            'status.in' => 'Trạng thái không hợp lệ',
        ]);

        try {
            $contacts = collect(session('driver_contacts', []));
            $contactIndex = $contacts->search(function($item) use ($id) {
                return $item['id'] === $id;
            });

            if ($contactIndex === false) {
                abort(404);
            }

            $contacts[$contactIndex] = array_merge($contacts[$contactIndex], [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'status' => $request->status,
                'admin_notes' => $request->admin_notes,
                'updated_at' => now(),
            ]);

            session(['driver_contacts' => $contacts->toArray()]);

            return redirect()->route('admin.driver.contacts.index')
                ->with('success', 'Liên hệ đã được cập nhật thành công!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Có lỗi xảy ra khi cập nhật liên hệ: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $contacts = collect(session('driver_contacts', []));
            $contacts = $contacts->filter(function($item) use ($id) {
                return $item['id'] !== $id;
            });

            session(['driver_contacts' => $contacts->toArray()]);

            return redirect()->route('admin.driver.contacts.index')
                ->with('success', 'Liên hệ đã được xóa thành công!');

        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi xóa liên hệ: ' . $e->getMessage());
        }
    }

    /**
     * Cập nhật trạng thái liên hệ
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:unread,read,replied,closed',
            'admin_notes' => 'nullable|string'
        ], [
            'status.required' => 'Trạng thái là bắt buộc',
            'status.in' => 'Trạng thái không hợp lệ'
        ]);

        try {
            $contacts = collect(session('driver_contacts', []));
            $contactIndex = $contacts->search(function($item) use ($id) {
                return $item['id'] === $id;
            });

            if ($contactIndex === false) {
                return response()->json([
                    'success' => false,
                    'message' => 'Liên hệ không tồn tại'
                ], 404);
            }

            $contacts[$contactIndex]['status'] = $request->status;
            $contacts[$contactIndex]['admin_notes'] = $request->admin_notes;
            $contacts[$contactIndex]['updated_at'] = now();

            session(['driver_contacts' => $contacts->toArray()]);

            $statusLabels = [
                'unread' => 'Chưa đọc',
                'read' => 'Đã đọc',
                'replied' => 'Đã trả lời',
                'closed' => 'Đã đóng'
            ];

            return response()->json([
                'success' => true,
                'message' => "Liên hệ đã được cập nhật trạng thái thành: {$statusLabels[$request->status]}",
                'status' => $request->status
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Đánh dấu đã đọc
     */
    public function markAsRead($id)
    {
        try {
            $contacts = collect(session('driver_contacts', []));
            $contactIndex = $contacts->search(function($item) use ($id) {
                return $item['id'] === $id;
            });

            if ($contactIndex === false) {
                return response()->json([
                    'success' => false,
                    'message' => 'Liên hệ không tồn tại'
                ], 404);
            }

            $contacts[$contactIndex]['status'] = 'read';
            $contacts[$contactIndex]['updated_at'] = now();

            session(['driver_contacts' => $contacts->toArray()]);

            return response()->json([
                'success' => true,
                'message' => 'Liên hệ đã được đánh dấu đã đọc'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Lọc liên hệ theo trạng thái
     */
    public function filterByStatus(Request $request)
    {
        $status = $request->get('status');
        $contacts = collect(session('driver_contacts', []));

        if ($status && $status !== 'all') {
            $contacts = $contacts->where('status', $status);
        }

        $contacts = $contacts->sortByDesc('created_at')->values();

        if ($request->ajax()) {
            return view('admin.driver.contacts.partials.contacts-table', compact('contacts'))->render();
        }

        return view('admin.driver.contacts.index', compact('contacts'));
    }

    /**
     * Tìm kiếm liên hệ
     */
    public function search(Request $request)
    {
        $search = $request->get('search');
        $contacts = collect(session('driver_contacts', []));

        if ($search) {
            $contacts = $contacts->filter(function($contact) use ($search) {
                return str_contains(strtolower($contact['name']), strtolower($search)) ||
                       str_contains(strtolower($contact['email']), strtolower($search)) ||
                       str_contains(strtolower($contact['phone']), strtolower($search)) ||
                       str_contains(strtolower($contact['subject']), strtolower($search)) ||
                       str_contains(strtolower($contact['message']), strtolower($search));
            });
        }

        $contacts = $contacts->sortByDesc('created_at')->values();

        if ($request->ajax()) {
            return view('admin.driver.contacts.partials.contacts-table', compact('contacts'))->render();
        }

        return view('admin.driver.contacts.index', compact('contacts'));
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,mark-read,mark-replied,mark-closed',
            'ids' => 'required|array'
        ]);

        try {
            $ids = $request->ids;
            $action = $request->action;
            $contacts = collect(session('driver_contacts', []));

            switch ($action) {
                case 'delete':
                    $contacts = $contacts->filter(function($item) use ($ids) {
                        return !in_array($item['id'], $ids);
                    });
                    $message = 'Đã xóa ' . count($ids) . ' liên hệ thành công!';
                    break;

                case 'mark-read':
                    $contacts = $contacts->map(function($item) use ($ids) {
                        if (in_array($item['id'], $ids)) {
                            $item['status'] = 'read';
                            $item['updated_at'] = now();
                        }
                        return $item;
                    });
                    $message = 'Đã đánh dấu đã đọc ' . count($ids) . ' liên hệ thành công!';
                    break;

                case 'mark-replied':
                    $contacts = $contacts->map(function($item) use ($ids) {
                        if (in_array($item['id'], $ids)) {
                            $item['status'] = 'replied';
                            $item['updated_at'] = now();
                        }
                        return $item;
                    });
                    $message = 'Đã đánh dấu đã trả lời ' . count($ids) . ' liên hệ thành công!';
                    break;

                case 'mark-closed':
                    $contacts = $contacts->map(function($item) use ($ids) {
                        if (in_array($item['id'], $ids)) {
                            $item['status'] = 'closed';
                            $item['updated_at'] = now();
                        }
                        return $item;
                    });
                    $message = 'Đã đánh dấu đã đóng ' . count($ids) . ' liên hệ thành công!';
                    break;
            }

            session(['driver_contacts' => $contacts->toArray()]);

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Xuất dữ liệu liên hệ
     */
    public function export(Request $request)
    {
        $status = $request->get('status');
        $contacts = collect(session('driver_contacts', []));

        if ($status && $status !== 'all') {
            $contacts = $contacts->where('status', $status);
        }

        $contacts = $contacts->sortByDesc('created_at')->values();

        // Tạo file CSV
        $filename = 'driver_contacts_' . date('Y-m-d_H-i-s') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($contacts) {
            $file = fopen('php://output', 'w');
            
            // Header
            fputcsv($file, [
                'Tên',
                'Email',
                'Số điện thoại',
                'Chủ đề',
                'Nội dung',
                'Trạng thái',
                'Ghi chú admin',
                'Ngày tạo'
            ]);

            // Data
            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact['name'],
                    $contact['email'],
                    $contact['phone'],
                    $contact['subject'],
                    $contact['message'],
                    $contact['status'],
                    $contact['admin_notes'],
                    $contact['created_at']->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Toggle trạng thái liên hệ
     */
    public function toggleStatus($id)
    {
        try {
            $contacts = collect(session('driver_contacts', []));
            $contact = $contacts->firstWhere('id', $id);

            if (!$contact) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy liên hệ'
                ], 404);
            }

            // Chuyển đổi trạng thái theo thứ tự: unread -> read -> replied -> unread
            $statusMap = [
                'unread' => 'read',
                'read' => 'replied',
                'replied' => 'unread'
            ];

            $newStatus = $statusMap[$contact['status']] ?? 'unread';
            
            // Cập nhật trạng thái
            $contacts = $contacts->map(function($item) use ($id, $newStatus) {
                if ($item['id'] === $id) {
                    $item['status'] = $newStatus;
                    $item['updated_at'] = now();
                }
                return $item;
            });

            session(['driver_contacts' => $contacts->toArray()]);

            return response()->json([
                'success' => true,
                'message' => 'Đã cập nhật trạng thái thành công',
                'new_status' => $newStatus,
                'status_text' => $this->getStatusText($newStatus)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Lấy text hiển thị cho trạng thái
     */
    private function getStatusText($status)
    {
        $statusLabels = [
            'unread' => 'Chưa đọc',
            'read' => 'Đã đọc',
            'replied' => 'Đã trả lời'
        ];

        return $statusLabels[$status] ?? ucfirst($status);
    }
}
