@extends('admin.layout')

@section('title','Tambah Produk')

@section('content')
<div class="flex items-center justify-between mb-4">
	<h1 class="text-xl font-bold flex items-center gap-2">
		<span class="material-symbols-outlined text-blue-600">post_add</span>
		Tambah Produk
	</h1>
	<a href="{{ route('admin.produk.index') }}" class="text-sm text-blue-600 hover:underline">Kembali</a>
</div>

<form method="POST" action="{{ route('admin.produk.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
@csrf

	<label class="block mb-2">Judul</label>
	<input name="title" value="{{ old('title') }}" class="w-full border rounded px-3 py-2 mb-3">

	<label class="block mb-2">Excerpt</label>
	<textarea name="excerpt" class="w-full border rounded px-3 py-2 mb-3">{{ old('excerpt') }}</textarea>

	<label class="block mb-2">Konten</label>
	<textarea name="content" id="editor" class="w-full border rounded px-3 py-2 mb-3"></textarea>

	<label class="block mb-2">Link</label>
	<input name="link" value="{{ old('link') }}" class="w-full border rounded px-3 py-2 mb-3">


	<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
		<div>
			<label class="block mb-2">Gambar</label>
			<input type="file" name="image">
		</div>

	</div>

	<label class="block mb-2">Meta Title</label>
	<input name="meta_title" value="{{ old('meta_title') }}" class="w-full border rounded px-3 py-2 mb-3">

	<div class="flex gap-2">
		<button class="bg-blue-600 text-white px-4 py-2 rounded inline-flex items-center gap-2">
			<span class="material-symbols-outlined">save</span>
			Simpan
		</button>

		<a href="{{ route('admin.produk.index') }}" class="px-4 py-2 rounded border border-blue-100 text-blue-700 hover:bg-blue-50 inline-flex items-center gap-2">
			<span class="material-symbols-outlined">arrow_back</span>
			Batal
		</a>
	</div>

</form>

@endsection
