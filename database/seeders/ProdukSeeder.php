<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Support\Str;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        $produk = [
            [
                'title' => 'Website Company Profile',
                'excerpt' => 'Website profesional untuk memperkenalkan perusahaan dan layanan bisnis Anda.',
                'content' => 'Kami menyediakan jasa pembuatan website company profile modern, responsif, dan SEO friendly untuk meningkatkan kredibilitas bisnis Anda.',
                'link' => 'https://demo-company-profile.com',
                'image' => 'produk/company-profile.jpg',
            ],
            [
                'title' => 'Website Toko Online',
                'excerpt' => 'Solusi e-commerce modern untuk meningkatkan penjualan online.',
                'content' => 'Website toko online lengkap dengan fitur keranjang belanja, pembayaran online, dan dashboard admin.',
                'link' => 'https://demo-tokoonline.com',
                'image' => 'produk/toko-online.jpg',
            ],
            [
                'title' => 'Aplikasi Kasir POS',
                'excerpt' => 'Aplikasi kasir digital untuk bisnis retail dan UMKM.',
                'content' => 'Sistem kasir modern dengan fitur laporan penjualan, stok barang, dan multi user.',
                'link' => 'https://demo-pos.com',
                'image' => 'produk/pos.jpg',
            ],
            [
                'title' => 'Website Sekolah',
                'excerpt' => 'Portal sekolah modern dengan fitur informasi dan PPDB online.',
                'content' => 'Website sekolah profesional lengkap dengan berita, galeri, dan sistem pendaftaran siswa baru.',
                'link' => 'https://demo-sekolah.com',
                'image' => 'produk/sekolah.jpg',
            ],
            [
                'title' => 'Sistem Manajemen Gudang',
                'excerpt' => 'Aplikasi inventory untuk mengelola stok barang secara efisien.',
                'content' => 'Sistem warehouse management dengan fitur stok masuk, keluar, dan laporan otomatis.',
                'link' => 'https://demo-gudang.com',
                'image' => 'produk/gudang.jpg',
            ],
            [
                'title' => 'Website Travel & Tour',
                'excerpt' => 'Website pemesanan paket wisata dan travel online.',
                'content' => 'Platform travel modern dengan fitur booking paket wisata, galeri, dan pembayaran online.',
                'link' => 'https://demo-travel.com',
                'image' => 'produk/travel.jpg',
            ],
            [
                'title' => 'Website Klinik',
                'excerpt' => 'Website layanan kesehatan profesional dan modern.',
                'content' => 'Website klinik lengkap dengan jadwal dokter, booking online, dan informasi layanan kesehatan.',
                'link' => 'https://demo-klinik.com',
                'image' => 'produk/klinik.jpg',
            ],
            [
                'title' => 'Sistem HRD & Payroll',
                'excerpt' => 'Aplikasi HR untuk absensi, payroll, dan manajemen karyawan.',
                'content' => 'Sistem HRD digital dengan fitur penggajian otomatis, absensi, dan cuti online.',
                'link' => 'https://demo-hrd.com',
                'image' => 'produk/hrd.jpg',
            ],
            [
                'title' => 'Website Restoran',
                'excerpt' => 'Website restoran dengan menu digital dan reservasi online.',
                'content' => 'Website restoran modern dengan tampilan menu menarik dan sistem booking meja.',
                'link' => 'https://demo-resto.com',
                'image' => 'produk/restoran.jpg',
            ],
            [
                'title' => 'Aplikasi Booking Hotel',
                'excerpt' => 'Platform reservasi hotel dan penginapan online.',
                'content' => 'Sistem booking hotel lengkap dengan pencarian kamar, pembayaran, dan dashboard admin.',
                'link' => 'https://demo-hotel.com',
                'image' => 'produk/hotel.jpg',
            ],
        ];

        foreach ($produk as $item) {
            Produk::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'excerpt' => $item['excerpt'],
                'content' => $item['content'],
                'link' => $item['link'],
                'image' => $item['image'],
                'meta_title' => $item['title'],
                'published_at' => now(),
                'user_id' => $user?->id,
            ]);
        }
    }
}