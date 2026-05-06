<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Settings;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Yayasan',
            'email' => 'admin@yayasan.id',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

      
    }
}
