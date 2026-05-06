<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\LandingSection;
use App\Models\Page;
use App\Models\News;
use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin Yayasan',
            'email' => 'admin@yayasan.id',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        // Create Settings
        Setting::create([
            'site_name' => 'Yayasan Sosial Indonesia',
            'address' => 'Jl. Merdeka No. 123, Jakarta, Indonesia',
            'phone' => '+62-21-1234567',
            'email' => 'info@yayasan.id',
            'facebook' => 'https://facebook.com/yayasansosialk',
            'instagram' => 'https://instagram.com/yayasansosiald',
            'youtube' => 'https://youtube.com/@yayasansosial',
        ]);

        // Create Landing Sections
        LandingSection::create([
            'key' => 'tentang',
            'title' => 'Tentang Kami',
            'content' => '<p>Yayasan Sosial Indonesia adalah organisasi nirlaba yang berkomitmen untuk meningkatkan kualitas hidup masyarakat. Dengan pengalaman lebih dari 10 tahun, kami telah membantu ribuan keluarga melalui berbagai program sosial dan pemberdayaan masyarakat.</p>',
            'order' => 1,
            'is_active' => true,
        ]);

        LandingSection::create([
            'key' => 'visi_misi',
            'title' => 'Visi & Misi',
            'content' => '<h3>Visi</h3><p>Menjadi organisasi sosial terpercaya yang memberdayakan masyarakat menuju kehidupan yang lebih baik dan sejahtera.</p><h3>Misi</h3><ul><li>Memberikan bantuan sosial kepada masyarakat yang membutuhkan</li><li>Melaksanakan program pendidikan dan pemberdayaan masyarakat</li><li>Membangun kemitraan dengan berbagai stakeholder</li><li>Mempromosikan nilai-nilai kemanusiaan dan keadilan sosial</li></ul>',
            'order' => 2,
            'is_active' => true,
        ]);

        LandingSection::create([
            'key' => 'program',
            'title' => 'Program Utama',
            'content' => '<p>Kami memiliki beberapa program unggulan untuk memberikan dampak maksimal kepada masyarakat:</p><ul><li><strong>Program Pendidikan:</strong> Beasiswa dan pelatihan keterampilan untuk anak-anak kurang mampu</li><li><strong>Program Kesehatan:</strong> Pemeriksaan kesehatan gratis dan pendidikan gizi masyarakat</li><li><strong>Program Pemberdayaan Ekonomi:</strong> Pelatihan UMKM dan akses modal usaha</li><li><strong>Program Lingkungan:</strong> Pelestarian alam dan gerakan hidup sehat</li></ul>',
            'order' => 3,
            'is_active' => true,
        ]);

        // Create Pages
        Page::create([
            'slug' => 'profil',
            'title' => 'Profil Yayasan',
            'meta_title' => 'Profil Yayasan Sosial Indonesia',
            'meta_description' => 'Kenali lebih jauh tentang yayasan kami, sejarah, dan pencapaian',
            'content' => '<p>Yayasan Sosial Indonesia didirikan pada tahun 2014 sebagai wadah untuk memberikan kontribusi nyata kepada masyarakat. Dengan tim yang profesional dan berdedikasi, kami telah melaksanakan berbagai program sosial yang memberikan manfaat bagi ribuan penerima manfaat.</p><p>Hingga saat ini, kami terus berinovasi dan berkembang untuk menjangkau lebih banyak masyarakat yang membutuhkan bantuan dan pemberdayaan.</p>',
            'is_active' => true,
        ]);

        Page::create([
            'slug' => 'visi-misi',
            'title' => 'Visi & Misi',
            'meta_title' => 'Visi dan Misi Yayasan',
            'meta_description' => 'Visi dan misi yayasan dalam memberikan dampak sosial',
            'content' => '<h2>Visi</h2><p>Menjadi organisasi sosial terpercaya yang memberdayakan masyarakat menuju kehidupan yang lebih baik dan sejahtera.</p><h2>Misi</h2><ol><li>Memberikan bantuan sosial kepada masyarakat yang membutuhkan</li><li>Melaksanakan program pendidikan dan pemberdayaan masyarakat</li><li>Membangun kemitraan dengan berbagai stakeholder</li><li>Mempromosikan nilai-nilai kemanusiaan dan keadilan sosial</li></ol>',
            'is_active' => true,
        ]);

        Page::create([
            'slug' => 'kontak',
            'title' => 'Kontak Kami',
            'meta_title' => 'Hubungi Kami',
            'meta_description' => 'Hubungi yayasan kami melalui kontak yang tersedia',
            'content' => '<h2>Hubungi Kami</h2><p><strong>Alamat:</strong><br>Jl. Merdeka No. 123<br>Jakarta, Indonesia</p><p><strong>Telepon:</strong><br>+62-21-1234567</p><p><strong>Email:</strong><br>info@yayasan.id</p><p><strong>Jam Operasional:</strong><br>Senin - Jumat: 08:00 - 17:00 WIB<br>Sabtu - Minggu: Tutup</p>',
            'is_active' => true,
        ]);

        // Create Menus
        Menu::create([
            'title' => 'Profil',
            'url' => route('profil'),
            'order' => 1,
            'is_active' => true,
        ]);

        Menu::create([
            'title' => 'Visi & Misi',
            'url' => route('visi-misi'),
            'order' => 2,
            'is_active' => true,
        ]);

        // Create Sample News
        $news1 = News::create([
            'title' => 'Program Beasiswa Pendidikan Dimulai Tahun 2025',
            'slug' => 'program-beasiswa-pendidikan-2025',
            'excerpt' => 'Yayasan dengan bangga mengumumkan dimulainya program beasiswa pendidikan untuk tahun akademik 2025.',
            'content' => '<p>Yayasan Sosial Indonesia dengan bangga mengumumkan dimulainya program beasiswa pendidikan untuk tahun akademik 2025. Program ini ditujukan untuk siswa berprestasi yang berasal dari keluarga kurang mampu.</p><h3>Kriteria Penerima Beasiswa:</h3><ul><li>Siswa SD hingga SMA dari keluarga kurang mampu</li><li>Memiliki prestasi akademik yang baik (minimal rata-rata 7,5)</li><li>Berdomisili di wilayah Jakarta dan sekitarnya</li><li>Memiliki surat rekomendasi dari sekolah</li></ul><h3>Periode Pendaftaran:</h3><p>Pendaftaran dibuka mulai 1 Januari hingga 28 Februari 2025. Silakan mengunjungi kantor yayasan atau menghubungi kami untuk informasi lebih lanjut.</p>',
            'meta_title' => 'Program Beasiswa Pendidikan 2025',
            'meta_description' => 'Informasi tentang program beasiswa pendidikan yayasan tahun 2025',
            'published_at' => now()->subDays(5),
            'user_id' => $admin->id,
        ]);

        $news2 = News::create([
            'title' => 'Kegiatan Pemeriksaan Kesehatan Gratis Sukses Dilaksanakan',
            'slug' => 'pemeriksaan-kesehatan-gratis',
            'excerpt' => 'Kegiatan pemeriksaan kesehatan gratis telah sukses diikuti oleh lebih dari 200 peserta dari berbagai kalangan.',
            'content' => '<p>Kegiatan pemeriksaan kesehatan gratis yang diselenggarakan oleh Yayasan Sosial Indonesia bersama dengan tenaga medis profesional telah sukses dilaksanakan pada hari Sabtu lalu.</p><p>Kegiatan yang berlokasi di lapangan Merdeka ini dihadiri oleh lebih dari 200 peserta yang berasal dari berbagai kalangan masyarakat lokal. Peserta mendapatkan pemeriksaan kesehatan gratis mencakup pemeriksaan tekanan darah, pemeriksaan kolesterol, dan konsultasi kesehatan umum.</p><h3>Hasil Kegiatan:</h3><ul><li>Total peserta: 215 orang</li><li>Kasus yang dirujuk ke rumah sakit: 12 orang</li><li>Total paket vitamin dan obat yang diberikan: 215 paket</li></ul><p>Kami berterima kasih atas antusiasme masyarakat dan dukungan dari para tenaga medis yang telah membantu kesuksesan kegiatan ini.</p>',
            'meta_title' => 'Pemeriksaan Kesehatan Gratis',
            'meta_description' => 'Laporan kegiatan pemeriksaan kesehatan gratis yayasan',
            'published_at' => now()->subDays(10),
            'user_id' => $admin->id,
        ]);

        $news3 = News::create([
            'title' => 'Pelatihan UMKM dan Akses Modal Usaha Dibuka untuk Masyarakat',
            'slug' => 'pelatihan-umkm-modal-usaha',
            'excerpt' => 'Yayasan membuka program pelatihan UMKM dan fasilitas akses modal usaha untuk memberdayakan ekonomi masyarakat.',
            'content' => '<p>Sebagai bagian dari komitmen kami dalam memberdayakan ekonomi masyarakat, Yayasan Sosial Indonesia membuka program pelatihan UMKM dan fasilitas akses modal usaha.</p><p>Program ini dirancang khusus untuk membantu masyarakat yang ingin memulai atau mengembangkan usaha kecil dan menengah mereka.</p><h3>Benefit Program:</h3><ul><li>Pelatihan manajemen bisnis dan keuangan UMKM</li><li>Bimbingan teknis produksi dan pemasaran</li><li>Akses ke pasar dan jaringan bisnis</li><li>Pendampingan selama 6 bulan</li><li>Kemudahan akses modal dengan bunga rendah</li></ul><p>Pendaftaran dibuka untuk 50 calon peserta. Silakan hubungi kantor yayasan untuk informasi lengkap dan persyaratan pendaftaran.</p>',
            'meta_title' => 'Pelatihan UMKM dan Modal Usaha',
            'meta_description' => 'Program pelatihan UMKM dan akses modal usaha dari yayasan',
            'published_at' => now()->subDays(15),
            'user_id' => $admin->id,
        ]);
    }
}
