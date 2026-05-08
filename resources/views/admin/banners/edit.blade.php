@extends('admin.layout')

@section('title','Edit Banner')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined text-blue-600">edit</span>
        Edit Banner
    </h1>
</div>

<form method="POST" action="{{ route('admin.banners.update', $banner) }}" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
@csrf @method('PUT')

    <label class="block mb-2">Judul</label>
    <input name="judul" value="{{ old('judul', $banner->judul) }}" class="w-full border rounded px-3 py-2 mb-2 focus:outline-none focus:ring-2 focus:ring-blue-200">
    @error('judul') <p class="text-red-600 text-sm mb-2">{{ $message }}</p> @enderror

    <label class="block mb-2">Deskripsi</label>
    <textarea name="deskripsi" id="editor" class="w-full border rounded px-3 py-2 mb-2">{!! old('deskripsi', $banner->deskripsi) !!}</textarea>
    @error('deskripsi') <p class="text-red-600 text-sm mb-2">{{ $message }}</p> @enderror

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block mb-2">Gambar</label>
            @if($banner->image)
                <img src="{{ asset('img/banners/'.$banner->image) }}" class="h-32 mb-2 rounded">
            @endif
            <input type="file" name="image" class="mb-2">
            @error('image') <p class="text-red-600 text-sm mb-2">{{ $message }}</p> @enderror
        </div>
    </div>


    <div class="flex items-center gap-3">
        <button class="bg-blue-600 text-white px-4 py-2 rounded inline-flex items-center gap-2">
            <span class="material-symbols-outlined">save</span>
            Update
        </button>

        <a href="{{ route('admin.banners.index') }}" class="px-4 py-2 rounded border border-blue-100 text-blue-700 hover:bg-blue-50 inline-flex items-center gap-2">
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
