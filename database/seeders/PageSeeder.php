<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        Page::create([
            'slug'               => 'profil',
            'title'              => 'Profil Yayasan',
            'content'            => '<h2>Profil Yayasan</h2><p>Ini adalah halaman profil yayasan kami. Anda bisa mengedit konten ini di Admin Panel.</p>',
            'meta_title'         => 'Profil Yayasan',
            'meta_description'   => 'Kenali lebih jauh tentang yayasan kami',
            'is_active'          => true,
        ]);

        Page::create([
            'slug'               => 'visi-misi',
            'title'              => 'Visi & Misi',
            'content'            => '<h2>Visi & Misi Yayasan</h2><p><strong>Visi:</strong> Menjadi yayasan terdepan dalam pelayanan masyarakat.</p><p><strong>Misi:</strong> Memberikan dukungan dan pendampingan kepada masyarakat yang membutuhkan.</p>',
            'meta_title'         => 'Visi & Misi Yayasan',
            'meta_description'   => 'Visi dan misi yayasan kami',
            'is_active'          => true,
        ]);

        Page::create([
            'slug'               => 'kontak',
            'title'              => 'Hubungi Kami',
            'content'            => '<h2>Hubungi Kami</h2><p>Kami siap membantu Anda. Hubungi kami melalui informasi kontak di bawah:</p><p><strong>Email:</strong> info@yayasan.com</p><p><strong>Telepon:</strong> (021) 123-4567</p><p><strong>Alamat:</strong> Jl. Contoh No. 123, Jakarta</p>',
            'meta_title'         => 'Hubungi Kami',
            'meta_description'   => 'Hubungi yayasan kami untuk informasi lebih lanjut',
            'is_active'          => true,
        ]);
    }
}
