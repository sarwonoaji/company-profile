@extends('admin.layout')

@section('title','Tambah Section')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined text-blue-600">add_box</span>
        Tambah Landing Section
    </h1>
    <a href="{{ route('admin.landing-sections.index') }}" class="text-sm text-blue-600 hover:underline">Kembali</a>
</div>

<form method="POST" action="{{ route('admin.landing-sections.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
@csrf

    <label class="block mb-2">Key <span class="text-xs text-gray-400">(hero, about, program)</span></label>
    <input name="key" value="{{ old('key') }}" class="w-full border rounded px-3 py-2 mb-2 focus:outline-none focus:ring-2 focus:ring-blue-200">
    @error('key') <p class="text-red-600 text-sm mb-2">{{ $message }}</p> @enderror

    <label class="block mb-2">Judul</label>
    <input name="title" value="{{ old('title') }}" class="w-full border rounded px-3 py-2 mb-2 focus:outline-none focus:ring-2 focus:ring-blue-200">
    @error('title') <p class="text-red-600 text-sm mb-2">{{ $message }}</p> @enderror

    <label class="block mb-2">Konten</label>
    <textarea name="content" id="editor" class="w-full border rounded px-3 py-2 mb-2">{{ old('content') }}</textarea>
    @error('content') <p class="text-red-600 text-sm mb-2">{{ $message }}</p> @enderror

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block mb-2">Urutan</label>
            <input type="number" name="order" value="{{ old('order', 0) }}" class="w-full border rounded px-3 py-2 mb-2 focus:outline-none focus:ring-2 focus:ring-blue-200">
            @error('order') <p class="text-red-600 text-sm mb-2">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-2">Gambar</label>
            <input type="file" name="image" class="mb-2">
            @error('image') <p class="text-red-600 text-sm mb-2">{{ $message }}</p> @enderror
        </div>
    </div>

    <label class="inline-flex items-center mb-4">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
        <span class="ml-2">Aktif</span>
    </label>

    <div class="flex items-center gap-3">
        <button class="bg-blue-600 text-white px-4 py-2 rounded inline-flex items-center gap-2">
            <span class="material-symbols-outlined">save</span>
            Simpan
        </button>

        <a href="{{ route('admin.landing-sections.index') }}" class="px-4 py-2 rounded border border-blue-100 text-blue-700 hover:bg-blue-50 inline-flex items-center gap-2">
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
