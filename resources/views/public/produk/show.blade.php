@extends('public.layout')

@section('title', $produk->meta_title ?? $produk->title)
@section('meta_description', $produk->meta_description ?? $produk->excerpt)

@section('content')

{{-- BREADCRUMB --}}
<div class="bg-gray-100 py-4">
    <div class="container mx-auto px-4">
        <div class="text-sm text-gray-600">
            <a href="{{ route('landing') }}" class="hover:text-blue-600">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('produk.index') }}" class="hover:text-blue-600">Produk</a>
            <span class="mx-2">/</span>
            <span class="text-gray-800 font-semibold">{{ $produk->title }}</span>
        </div>
    </div>
</div>

{{-- ARTICLE --}}
<article class="container mx-auto py-12 px-4">
    <div class="max-w-3xl mx-auto">
        {{-- HEADER --}}
        <header class="mb-8">
            <h1 class="text-4xl font-bold mb-4 text-gray-900">{{ $produk->title }}</h1>
            
            <div class="flex items-center justify-between text-gray-600 pb-6 border-b-2 border-gray-200">
            </div>
        </header>

        {{-- FEATURED IMAGE --}}
        @if($produk->image)
        <div class="mb-8">
            <img src="{{ asset('storage/'.$produk->image) }}"
                 alt="{{ $produk->title }}" 
                 class="w-full h-96 object-cover rounded-lg shadow-lg">
        </div>
        @endif

        {{-- CONTENT --}}
        <div class="prose prose-lg max-w-none mb-12">
            {!! $produk->content !!}
        </div>

        {{-- BACK BUTTON --}}
        <div class="text-center pt-8 border-t-2 border-gray-200">
            <a href="{{ $produk->link }}" 
                target="_blank"
                class="inline-block bg-blue-600 text-white px-6 py-3 rounded font-semibold hover:bg-blue-700 transition">
                    Demo Website
                </a>
        </div>
    </div>
</article>

@endsection