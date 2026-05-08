@extends('admin.layout')

@section('title','Tambah Menu')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined text-blue-600">add_box</span>
        Tambah Menu Baru
    </h1>
</div>

<form method="POST" action="{{ route('admin.menus.store') }}" class="max-w-2xl bg-white p-6 rounded shadow">
@csrf

<div class="mb-4">
    <label class="block font-semibold mb-2">Judul Menu *</label>
    <input type="text" name="title" value="{{ old('title') }}" 
           class="w-full border rounded px-3 py-2 @error('title') border-red-500 @enderror" 
           required>
    @error('title')
        <span class="text-red-600 text-sm">{{ $message }}</span>
    @enderror
</div>

<div class="mb-4">
    <label class="block font-semibold mb-2">URL / Link *</label>
    <input type="text" name="url" value="{{ old('url') }}" 
           class="w-full border rounded px-3 py-2 @error('url') border-red-500 @enderror" 
           required>
    @error('url')
        <span class="text-red-600 text-sm">{{ $message }}</span>
    @enderror
</div>

<div class="mb-4">
    <label class="block font-semibold mb-2">Urutan Menu</label>
    <input type="number" name="order" value="{{ old('order', 0) }}" 
           class="w-full border rounded px-3 py-2 @error('order') border-red-500 @enderror" 
           >
    <small class="text-gray-600">Menu dengan angka lebih kecil akan tampil lebih atas</small>
    @error('order')
        <span class="text-red-600 text-sm">{{ $message }}</span>
    @enderror
</div>

<div class="mb-4">
    <label class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
        <span class="font-semibold">Aktif di Navbar</span>
    </label>
</div>

<div class="flex gap-2">
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 inline-flex items-center gap-2">
        <span class="material-symbols-outlined">save</span>
        Simpan Menu
    </button>
    <a href="{{ route('admin.menus.index') }}" class="bg-gray-100 text-blue-700 px-6 py-2 rounded hover:bg-blue-50 inline-flex items-center gap-2 border border-blue-100">
        <span class="material-symbols-outlined">arrow_back</span>
        Batal
    </a>
</div>

</form>
@endsection
