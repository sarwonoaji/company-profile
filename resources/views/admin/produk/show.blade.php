@extends('admin.layout')

@section('title', $produk->title)

@section('content')
<div class="flex items-start justify-between gap-4 mb-4">
    <div class="flex items-center gap-3">
        <span class="material-symbols-outlined text-blue-600 text-3xl">article</span>
        <div>
            <h1 class="text-xl font-bold">{{ $produk->title }}</h1>
            <div class="text-sm text-slate-500">{{ $produk->slug }}</div>
        </div>
    </div>

   
</div>

<div class="bg-white rounded shadow overflow-hidden">
    @if($produk->image)
    <div class="w-full max-h-96 overflow-hidden">
        <img src="{{ asset('storage/'.$produk->image) }}" alt="{{ $produk->title }}" class="w-full h-56 object-cover">
    </div>
    @endif

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div>
                <div class="text-sm text-slate-500">Penulis</div>
                <div class="font-medium text-slate-800">{{ $produk->user?->name ?? 'N/A' }}</div>
            </div>

            <div>
            </div>
        </div>

        @if($produk->excerpt)
            <div class="mb-6 text-slate-700">{{ $produk->excerpt }}</div>
        @endif

        <div class="prose max-w-none mb-6">
            {!! $produk->content !!}
        </div>

        <div class="border-t pt-4 flex items-center justify-between">
            <div class="text-sm text-slate-600">
                <div><strong>Meta Title:</strong> {{ $produk->meta_title ?? '-' }}</div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('produk.show', $produk->slug) }}" target="_blank" class="inline-flex items-center gap-2 text-slate-700 border border-slate-200 px-3 py-2 rounded hover:bg-slate-50">
                    <span class="material-symbols-outlined">visibility</span>
                    Lihat Publik
                </a>

                <a href="{{ route('admin.produk.index') }}" class="inline-flex items-center gap-2 border border-slate-200 px-3 py-2 rounded text-sm text-slate-700 hover:bg-slate-50">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Kembali
                 </a>
            </div>
        </div>
    </div>
</div>
@endsection
