@extends('admin.layout')

@section('title','Tambah Halaman')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-600">add_box</span>
        Tambah Halaman
    </h1>
    <a href="{{ route('admin.pages.index') }}" class="text-sm text-emerald-600 hover:underline">Kembali</a>
</div>

<form method="POST" action="{{ route('admin.pages.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
@csrf

    <label class="block mb-2">Judul</label>
    <input name="title" class="w-full border rounded px-3 py-2 mb-3">

    <label class="block mb-2">Slug</label>
    <input name="slug" placeholder="profil / kontak / visi-misi" class="w-full border rounded px-3 py-2 mb-3">

    <label class="block mb-2">Konten</label>
    <textarea name="content" id="editor" class="w-full border rounded px-3 py-2 mb-3"></textarea>

    <label class="block mb-2">Meta Title</label>
    <input name="meta_title" class="w-full border rounded px-3 py-2 mb-3">

    <label class="inline-flex items-center mb-4">
        <input type="checkbox" name="is_active" value="1" checked>
        <span class="ml-2">Aktif</span>
    </label>

    <div class="flex gap-2">
        <button class="bg-emerald-600 text-white px-4 py-2 rounded inline-flex items-center gap-2">
            <span class="material-symbols-outlined">save</span>
            Simpan
        </button>

        <a href="{{ route('admin.pages.index') }}" class="px-4 py-2 rounded border border-emerald-100 text-emerald-700 hover:bg-emerald-50 inline-flex items-center gap-2">
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
