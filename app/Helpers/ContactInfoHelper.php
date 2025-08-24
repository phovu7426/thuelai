<?php

namespace App\Helpers;

use App\Models\ContactInfo;
use Illuminate\Support\Facades\Cache;

class ContactInfoHelper
{
    /**
     * Lấy thông tin liên hệ từ cache hoặc database
     * @return ContactInfo|null
     */
    public static function getContactInfo(): ?ContactInfo
    {
        return Cache::remember('contact_info', 3600, function () {
            return ContactInfo::first();
        });
    }

    /**
     * Xóa cache thông tin liên hệ
     * @return void
     */
    public static function clearCache(): void
    {
        Cache::forget('contact_info');
    }

    /**
     * Lấy thông tin liên hệ dưới dạng array để sử dụng trong view
     * @return array
     */
    public static function getContactInfoArray(): array
    {
        $contact = self::getContactInfo();
        
        if (!$contact) {
            return [
                'address' => '',
                'phone' => '',
                'email' => '',
                'working_time' => '',
                'facebook' => '',
                'instagram' => '',
                'youtube' => '',
                'linkedin' => '',
                'map_embed' => ''
            ];
        }

        return [
            'address' => $contact->address ?? '',
            'phone' => $contact->phone ?? '',
            'email' => $contact->email ?? '',
            'working_time' => $contact->working_time ?? '',
            'facebook' => $contact->facebook ?? '',
            'instagram' => $contact->instagram ?? '',
            'youtube' => $contact->youtube ?? '',
            'linkedin' => $contact->linkedin ?? '',
            'map_embed' => $contact->map_embed ?? ''
        ];
    }

    /**
     * Format số điện thoại để hiển thị
     * @param string|null $phone
     * @return string
     */
    public static function formatPhone(?string $phone): string
    {
        if (!$phone) return '';
        
        // Remove all non-numeric characters
        $phone = preg_replace('/\D/', '', $phone);
        
        // Format Vietnamese phone number
        if (strlen($phone) === 10 && str_starts_with($phone, '0')) {
            return substr($phone, 0, 4) . ' ' . substr($phone, 4, 3) . ' ' . substr($phone, 7);
        }
        
        return $phone;
    }

    /**
     * Lấy link social media với validation
     * @param string|null $url
     * @return string
     */
    public static function getSocialLink(?string $url): string
    {
        if (!$url) return '#';
        
        // Add https:// if not present
        if (!str_starts_with($url, 'http://') && !str_starts_with($url, 'https://')) {
            $url = 'https://' . $url;
        }
        
        return $url;
    }
}
