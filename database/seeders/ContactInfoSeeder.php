<?php

namespace Database\Seeders;

use App\Models\ContactInfo;
use Illuminate\Database\Seeder;

class ContactInfoSeeder extends Seeder
{
    public function run()
    {
        ContactInfo::create([
            'address' => '123 Đường ABC, Quận XYZ, TP.HCM',
            'phone' => '0123456789',
            'email' => 'contact@example.com',
            'working_time' => 'Thứ 2 - Thứ 6: 8:00 - 17:00',
            'facebook' => 'https://facebook.com/example',
            'instagram' => 'https://instagram.com/example',
            'youtube' => 'https://youtube.com/example',
            'linkedin' => 'https://linkedin.com/example'
        ]);
    }
} 