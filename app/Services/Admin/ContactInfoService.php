<?php

namespace App\Services\Admin;

use App\Helpers\ContactInfoHelper;
use App\Models\ContactInfo;
use Illuminate\Support\Facades\Schema;

class ContactInfoService
{
    /**
     * Lấy thông tin liên hệ
     * @return ContactInfo|null
     */
    public function getContactInfo(): ?ContactInfo
    {
        if (!Schema::hasTable('contact_infos')) {
            return null;
        }

        return ContactInfo::first();
    }

    /**
     * Cập nhật thông tin liên hệ
     * @param array $data
     * @return array
     */
    public function updateContactInfo(array $data): array
    {
        $return = [
            'success' => false,
            'message' => 'Cập nhật thông tin liên hệ thất bại'
        ];

        try {
            if (!Schema::hasTable('contact_infos')) {
                $return['message'] = 'Bảng contact_infos không tồn tại';
                return $return;
            }

            $contact = ContactInfo::first();

            if (!$contact) {
                $contact = ContactInfo::create($data);
            } else {
                $contact->update($data);
            }

            // Xóa cache sau khi cập nhật thành công
            ContactInfoHelper::clearCache();

            $return['success'] = true;
            $return['message'] = 'Cập nhật thông tin liên hệ thành công!';
            $return['data'] = $contact;
        } catch (\Exception $e) {
            $return['message'] = 'Có lỗi xảy ra: ' . $e->getMessage();
        }

        return $return;
    }
}
