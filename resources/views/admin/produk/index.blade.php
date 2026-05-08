@extends('admin.layout')

@section('title','Produk')

@section('content')
<div class="mb-2">
    <h1 class="text-2xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined text-blue-600">newspaper</span>
        Produk
    </h1>

    <div class="mt-3">
        <a href="{{ route('admin.produk.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded inline-flex items-center gap-2">
            <span class="material-symbols-outlined">add</span>
            Tambah Produk
        </a>
    </div>

</div>

    <div class="mt-4 flex items-center justify-between gap-4">
        <div class="text-sm text-slate-600">Menampilkan: {{ $produk->total() }} produk</div>

        <form method="GET" action="{{ route('admin.produk.index') }}" class="ml-auto flex items-center gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul atau isi..." class="form-input px-3 py-2 rounded border" />
            <button type="submit" class="bg-blue-600 text-white px-3 py-2 rounded">Cari</button>
            @if(request('q'))
                <a href="{{ route('admin.produk.index') }}" class="text-sm text-slate-600 ml-2">Reset</a>
            @endif
        </form>
    </div>

@if(session('success'))
    <div class="bg-blue-100 text-blue-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="mt-4 bg-white rounded shadow overflow-x-auto">
    <table class="w-full min-w-[720px]">
        <thead>
            <tr class="text-left bg-slate-700">
                <th class="p-3 text-slate-100">Gambar</th>
                <th class="p-3 text-slate-100">Judul</th>
                <th class="p-3 text-slate-100">Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($produk as $item)
            <tr class="border-b hover:bg-blue-50">
                <td class="p-3">
                    @if($item->image)
                        <img src="{{ asset('img/produk/'.$item->image) }}" class="h-14 rounded">
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </td>

                <td class="p-3">
                    <div class="font-semibold">{{ $item->title }}</div>
                    <div class="text-sm text-gray-500">{{ $item->slug }}</div>
                </td>

                <td class="p-3">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.produk.edit', $item) }}" class="inline-flex items-center justify-center w-8 h-8 rounded hover:bg-blue-50 text-blue-600 border border-transparent hover:border-blue-100" title="Edit">
                            <span class="material-symbols-outlined text-[18px]">edit</span>
                        </a>

                        <a href="{{ route('admin.produk.show', $item) }}" class="inline-flex items-center justify-center w-8 h-8 rounded hover:bg-slate-50 text-slate-700 border border-transparent hover:border-slate-100" title="Lihat">
                            <span class="material-symbols-outlined text-[18px]">visibility</span>
                        </a>

                        <form action="{{ route('admin.produk.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded hover:bg-red-50 text-red-600 border border-transparent hover:border-red-100" title="Hapus">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="p-6 text-center text-gray-500">Belum ada produk</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">
    {{ $produk->withQueryString()->links() }}
</div>
@endsection
