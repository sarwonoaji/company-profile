@extends('admin.layout')

@section('title','Edit Produk')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-600">edit</span>
        Edit Produk
    </h1>
</div>

<form method="POST" action="{{ route('admin.produk.update', $produk->id) }}" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
@csrf @method('PUT')

    <label class="block mb-2">Judul</label>
    <input name="title" value="{{ old('title', $produk->title) }}" class="w-full border rounded px-3 py-2 mb-3">

    <label class="block mb-2">Excerpt</label>
    <textarea name="excerpt" class="w-full border rounded px-3 py-2 mb-3">{{ old('excerpt', $produk->excerpt) }}</textarea>

    <label class="block mb-2">Konten</label>
    <textarea name="content" id="editor" class="w-full border rounded px-3 py-2 mb-3">{!! old('content', $produk->content) !!}</textarea>

    <label class="block mb-2">Link</label>
    <input name="link" value="{{ old('link', $produk->link) }}" class="w-full border rounded px-3 py-2 mb-3">

    @if($produk->image)
        <img src="{{ asset('img/produk/'.$produk->image) }}" class="h-32 mb-4 rounded">
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block mb-2">Gambar</label>
            <input type="file" name="image">
        </div>
    </div>

    <label class="block mb-2">Meta Title</label>
    <input name="meta_title" value="{{ old('meta_title', $produk->meta_title) }}" class="w-full border rounded px-3 py-2 mb-3">
 
    <div class="flex gap-2">
        <button class="bg-emerald-600 text-white px-4 py-2 rounded inline-flex items-center gap-2">
            <span class="material-symbols-outlined">save</span>
            Update
        </button>

        <a href="{{ route('admin.produk.index') }}" class="px-4 py-2 rounded border border-emerald-100 text-emerald-700 hover:bg-emerald-50 inline-flex items-center gap-2">
            <span class="material-symbols-outlined">arrow_back</span>
            Batal
        </a>
    </div>

</form>

@push('scripts')
    <script>
        // Initialization is handled by resources/js/ckeditor.js via app.js
    </script>
@endpush
@endsection
