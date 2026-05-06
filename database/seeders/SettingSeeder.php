<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'site_name' => 'Yayasan Contoh',
            'address' => 'Jl. Jalan No. 123, Kota Contoh, Provinsi',
            'phone' => '+62-xxx-xxxx-xxxx',
            'email' => 'info@yayasan.example.com',
            'facebook' => 'https://facebook.com/yayasan.contoh',
            'instagram' => 'https://instagram.com/yayasan.contoh',
            'youtube' => 'https://youtube.com/@yayasan.contoh',
        ]);
    }
}
