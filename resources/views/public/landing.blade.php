@extends('public.layout')

@section('title', 'Beranda - ' . ($settings->site_name ?? 'Website'))
@section('meta_description', 'Selamat datang di website resmi yayasan kami.')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    .hero-slider {
        position: relative;
        height: 500px;
    }
    
    .hero-slider .swiper-slide {
        position: relative;
        overflow: hidden;
    }
    
    .hero-slider .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .hero-slider .swiper-slide::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.6), rgba(29, 78, 216, 0.6));
        z-index: 2;
    }
    
    .hero-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
        z-index: 3;
        width: 90%;
        max-width: 800px;
    }
    
    .swiper-pagination-bullet {
        background: rgba(255, 255, 255, 0.5) !important;
    }
    
    .swiper-pagination-bullet-active {
        background: white !important;
    }
    
    .swiper-button-next,
    .swiper-button-prev {
        color: white !important;
        --swiper-navigation-size: 30px !important;
    }
</style>
@endpush

@section('content')

{{-- HERO BANNER COMPANY PROFILE --}}
<section class="relative overflow-hidden bg-gradient-to-br from-blue-700 via-blue-600 to-blue-500 text-white">

    {{-- Background Decoration --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
    </div>

    <div class="container mx-auto px-6 py-20 relative z-10">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- LEFT CONTENT --}}
            <div data-aos="fade-right">

                <span class="inline-block px-4 py-2 bg-white/20 rounded-full text-sm font-medium mb-6 backdrop-blur">
                    🚀 Jasa Pembuatan Website Profesional
                </span>

                <!-- <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">
                    Bangun Website Modern untuk Bisnis Anda
                </h1> -->

                 <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">
                   
                    {{ $banners->first()->judul ?? 'Bangun' }}
                </h1>

                <!-- <p class="text-xl text-blue-100 leading-relaxed mb-10 max-w-2xl">
                    Kami membantu bisnis, UMKM, dan company profile tampil lebih profesional
                    melalui website modern, responsive, cepat, dan berkualitas tinggi
                    untuk meningkatkan branding serta kepercayaan pelanggan.
                </p> -->

               <div class="text-xl text-blue-100 leading-relaxed mb-10 max-w-2xl">
                    {!! $banners->first()->deskripsi ?? 'Kami membantu' !!}
                </div>

                {{-- BUTTON --}}
                <div class="flex flex-wrap gap-4">

                    <a href="{{ route('profil') }}"
                        class="bg-white text-blue-700 px-8 py-4 rounded-xl font-semibold shadow-lg hover:bg-gray-100 transition duration-300">
                        Tentang Kami
                    </a>

                    <a href="{{ route('kontak') }}"
                        class="border border-white/40 px-8 py-4 rounded-xl font-semibold hover:bg-white/10 transition duration-300 backdrop-blur">
                        Hubungi Kami
                    </a>

                </div>

                {{-- STATS --}}
                <!-- <div class="flex flex-wrap gap-10 mt-14">

                    <div>
                        <h3 class="text-3xl font-bold">100+</h3>
                        <p class="text-blue-100">Project Website</p>
                    </div>

                    <div>
                        <h3 class="text-3xl font-bold">50+</h3>
                        <p class="text-blue-100">Client Puas</p>
                    </div>

                    <div>
                        <h3 class="text-3xl font-bold">24/7</h3>
                        <p class="text-blue-100">Support Online</p>
                    </div>

                </div> -->

            </div>

            {{-- RIGHT IMAGE --}}
            <div class="relative" data-aos="fade-left">

                <div class="relative z-10">
                    <img src="{{ asset('img/banners/'.$banners->first()->image) }}"
                        alt="Company Profile"
                        class="w-full rounded-3xl shadow-2xl">
                </div>

            </div>

        </div>

    </div>
</section>

{{-- DYNAMIC SECTIONS --}}
@foreach($sections as $section)
<section class="py-20 @if($loop->even) bg-gray-50 @endif">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-5xl font-bold mb-8 text-blue-600" data-aos="fade-up">{{ $section->title }}</h2>

            @if($section->image)
            <div class="mb-12 overflow-hidden rounded-xl shadow-lg" data-aos="zoom-in" data-aos-delay="200">
                <img src="{{ asset('img/landing/'.$section->image) }}" alt="{{ $section->title }}" class="w-full h-96 object-cover hover:scale-105 transition-transform duration-500">
            </div>
            @endif

            <div class="prose prose-lg max-w-none text-gray-700" data-aos="fade-up" data-aos-delay="300">
                {!! $section->content !!}
            </div>
        </div>
    </div>
</section>
@endforeach

{{-- SERVICES / FEATURES SECTION --}}
<section class="py-24 bg-gray-50">
    <div class="container mx-auto px-4">

        {{-- HEADING --}}
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Kenapa Memilih Kami
            </h2>

            <p class="text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">
                Solusi pembuatan website profesional dengan proses mudah,
                cepat, modern, dan siap membantu bisnis Anda berkembang
                lebih maksimal di era digital.
            </p>
        </div>

        {{-- CONTENT --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

            {{-- ITEM 1 --}}
            <div class="text-center group" data-aos="fade-up" data-aos-delay="100">

                <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-blue-100 flex items-center justify-center group-hover:scale-110 transition duration-300">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-4l-4 4v-4z">
                        </path>
                    </svg>
                </div>

                <h3 class="text-2xl font-semibold text-gray-900 mb-4">
                    Konsultasi & Konsep Website
                </h3>

                <p class="text-gray-500 leading-relaxed text-lg">
                    Cukup jelaskan kebutuhan bisnis Anda dan kami akan membantu
                    merancang website profesional yang modern, responsive,
                    dan sesuai dengan identitas brand perusahaan Anda.
                </p>
            </div>

            {{-- ITEM 2 --}}
            <div class="text-center group" data-aos="fade-up" data-aos-delay="200">

                <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-blue-100 flex items-center justify-center group-hover:scale-110 transition duration-300">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 3v4M3 5h4m10-2l2 2m0 0l2 2m-2-2l-2 2m2-2l2-2M4 13a8 8 0 1116 0 8 8 0 01-16 0z">
                        </path>
                    </svg>
                </div>

                <h3 class="text-2xl font-semibold text-gray-900 mb-4">
                    Desain Modern & Custom
                </h3>

                <p class="text-gray-500 leading-relaxed text-lg">
                    Website dibuat dengan desain elegan, cepat, modern,
                    dan mudah digunakan. Tampilan serta fitur dapat
                    disesuaikan dengan kebutuhan bisnis Anda.
                </p>
            </div>

            {{-- ITEM 3 --}}
            <div class="text-center group" data-aos="fade-up" data-aos-delay="300">

                <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-blue-100 flex items-center justify-center group-hover:scale-110 transition duration-300">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z">
                        </path>
                    </svg>
                </div>

                <h3 class="text-2xl font-semibold text-gray-900 mb-4">
                    Website Siap Online
                </h3>

                <p class="text-gray-500 leading-relaxed text-lg">
                    Setelah proses selesai, website dapat langsung online
                    menggunakan domain dan hosting pilihan Anda sehingga
                    bisnis siap tampil profesional di dunia digital.
                </p>
            </div>

        </div>
    </div>
</section>

{{-- LATEST NEWS SECTION --}}
<section class="py-20 bg-gradient-to-br from-slate-900 to-slate-800 text-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-5xl font-bold mb-4">Produk Kami</h2>
            <p class="text-xl text-gray-300">Produk Terbaru Kami</p>
            <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-blue-600 mx-auto mt-6"></div>
        </div>

        @if($latestNews->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($latestNews as $produk)
            <article class="card-hover bg-slate-800 rounded-xl overflow-hidden shadow-lg group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                @if($produk->image)
                <div class="h-48 overflow-hidden relative">
                    <img src="{{ asset('img/produk/'.$produk->image) }}" alt="{{ $produk->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                @endif

                <div class="p-6">
                    <h3 class="text-xl font-bold mb-3 line-clamp-2 text-white group-hover:text-blue-400 transition-colors">
                        {{ $produk->title }}
                    </h3>

                    <p class="text-gray-400 text-sm line-clamp-3 mb-5">
                        {{ $produk->excerpt ?? substr(strip_tags($produk->content), 0, 150) }}
                    </p>

                    <a href="{{ route('produk.show', $produk->slug) }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 font-semibold transition-colors group">
                        Baca Selengkapnya
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <div class="text-center">
            <a href="{{ route('produk.index') }}" class="btn-primary">
                Lihat Semua Produk
            </a>
        </div>
        @else
        <div class="text-center py-12">
            <p class="text-gray-400 text-lg">Belum ada produk terbaru</p>
        </div>
        @endif
    </div>
</section>

{{-- CALL TO ACTION --}}
<section class="py-20 bg-gradient-to-r from-blue-600 to-blue-700 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-white rounded-full"></div>
    </div>
    
    <div class="container mx-auto px-4 text-center relative z-10" data-aos="zoom-in">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">Ada Pertanyaan untuk Kami?</h2>
        <p class="text-xl text-blue-100 mb-10 max-w-2xl mx-auto">
            Kami siap membantu Anda. Hubungi kami kapan saja melalui berbagai saluran komunikasi yang tersedia
        </p>

        <a href="{{ route('kontak') }}" class="btn-primary">
            Hubungi Kami Sekarang
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    const heroSlider = new Swiper('.hero-slider', {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        }
    });
</script>
@endpush