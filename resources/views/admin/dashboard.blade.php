@extends('admin.layout')

@section('title', 'Dashboard')

@section('page-title')
    <h1 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-600">dashboard</span>
        Dashboard Admin
    </h1>
@endsection

@section('content')

{{-- Content Management Statistics --}}
<div class="bg-white rounded shadow p-6 mb-6">
    <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-600">article</span>
        Manajemen Konten
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-emerald-50 p-4 rounded flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-100 rounded flex items-center justify-center text-emerald-600">
                    <span class="material-symbols-outlined">article</span>
                </div>
                <div>
                    <h3 class="text-sm text-gray-600">Total Produk</h3>
                    <p class="text-2xl font-bold text-emerald-700">{{ $totalNews }}</p>
                </div>
            </div>
        </div>

        <div class="bg-emerald-50 p-4 rounded flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-100 rounded flex items-center justify-center text-emerald-600">
                    <span class="material-symbols-outlined">check_circle</span>
                </div>
                <div>
                    <h3 class="text-sm text-gray-600">Produk Publish</h3>
                    <p class="text-2xl font-bold text-emerald-700">{{ $publishedNews }}</p>
                </div>
            </div>
        </div>

        <div class="bg-emerald-50 p-4 rounded flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-100 rounded flex items-center justify-center text-emerald-600">
                    <span class="material-symbols-outlined">edit_note</span>
                </div>
            </div>
        </div>

        <div class="bg-emerald-50 p-4 rounded flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-100 rounded flex items-center justify-center text-emerald-600">
                    <span class="material-symbols-outlined">view_in_ar</span>
                </div>
                <div>
                    <h3 class="text-sm text-gray-600">Landing Section</h3>
                    <p class="text-2xl font-bold text-emerald-700">{{ $landingSections }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

</div>


{{-- Quick Actions --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Content Management Actions --}}
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-emerald-600">article</span>
            Aksi Konten
        </h2>

        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.produk.create') }}"
               class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700 flex items-center gap-2">
               <span class="material-symbols-outlined">post_add</span>
               + Tambah Produk
            </a>

            <a href="{{ route('admin.landing-sections.index') }}"
               class="bg-emerald-50 text-emerald-700 px-4 py-2 rounded hover:bg-emerald-100 flex items-center gap-2 border border-emerald-100">
               <span class="material-symbols-outlined">web</span>
               Kelola Landing Page
            </a>

            <a href="{{ route('admin.pages.index') }}"
               class="bg-emerald-50 text-emerald-700 px-4 py-2 rounded hover:bg-emerald-100 flex items-center gap-2 border border-emerald-100">
               <span class="material-symbols-outlined">description</span>
               Kelola Halaman
            </a>
        </div>
    </div>
</div>

@endsection
