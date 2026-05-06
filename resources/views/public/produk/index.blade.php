@extends('public.layout')

@section('title','Produk Kamai')
@section('meta_description', 'Baca berita dan pengumuman terbaru dari yayasan kami')

@section('content')

{{-- BREADCRUMB --}}
<div class="bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200 py-6">
    <div class="container mx-auto px-4">
        <div class="flex items-center text-sm text-gray-600 space-x-2">
            <a href="{{ route('landing') }}" class="hover:text-blue-600 transition-colors flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2.83-2.83a1 1 0 011.41 0L12 12m0 0l3.76-3.76a1 1 0 011.41 0L21 12M5 6h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z"></path></svg>
                Beranda
            </a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">Produk</span>
        </div>
    </div>
</div>

{{-- HEADER --}}
<div class="bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full"></div>
    </div>
    <div class="container mx-auto px-4 text-center relative z-10" data-aos="fade-up">
        <h1 class="text-5xl font-bold mb-4">Produk Kami</h1>
        <p class="text-xl text-blue-100">Produk Terbaru Kami</p>
        <div class="w-20 h-1 bg-gradient-to-r from-blue-300 to-blue-400 mx-auto mt-6"></div>
    </div>
</div>

{{-- NEWS LIST --}}
<div class="container mx-auto py-16 px-4">
    @if($produk->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        @foreach($produk as $item)
        <article class="card-hover bg-white rounded-xl overflow-hidden shadow-lg group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="relative h-48 overflow-hidden bg-gray-200">
                @if($item->image)
                    <img src="{{ asset('img/produk/'.$item->image) }}" 
                         alt="{{ $item->title }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-500 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
                <div class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                    {{ $item->published_at->translatedFormat('j M Y') }}
                </div>
            </div>

            <div class="p-6">
                <h2 class="text-xl font-bold mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors">
                    <a href="{{ route('produk.show', $item->slug) }}">
                        {{ $item->title }}
                    </a>
                </h2>

                <p class="text-gray-600 text-sm line-clamp-3 mb-5">
                    {{ $item->excerpt ?? substr(strip_tags($item->content), 0, 150) }}
                </p>

                <a href="{{ route('produk.show', $item->slug) }}" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold transition-colors group">
                    Baca Selengkapnya
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </article>
        @endforeach
    </div>

    {{-- FANCY PAGINATION --}}
    @if($produk->hasPages())
    <div class="pagination" data-aos="fade-up">
        {{-- Previous Page Link --}}
        @if ($produk->onFirstPage())
            <span class="disabled">
                <span class="opacity-50">← Sebelumnya</span>
            </span>
        @else
            <a href="{{ $produk->previousPageUrl() }}" class="flex items-center gap-1">
                <span>← Sebelumnya</span>
            </a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($produk->getUrlRange(1, $produk->lastPage()) as $page => $url)
            @if ($page == $produk->currentPage())
                <span class="active">
                    <span>{{ $page }}</span>
                </span>
            @else
                <a href="{{ $url }}">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($produk->hasMorePages())
            <a href="{{ $produk->nextPageUrl() }}" class="flex items-center gap-1">
                <span>Selanjutnya →</span>
            </a>
        @else
            <span class="disabled">
                <span class="opacity-50">Selanjutnya →</span>
            </span>
        @endif
    </div>
    @endif

    @else
    <div class="text-center py-16" data-aos="fade-up">
        <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <p class="text-gray-500 text-lg font-medium">Belum ada produk</p>
        <p class="text-gray-400 mt-2">Nantikan produk terbaru dari kami</p>
    </div>
    @endif
</div>

@endsection