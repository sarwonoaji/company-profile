@extends('admin.layout')

@section('title','Produk')

@section('content')
<div class="mb-2">
    <h1 class="text-2xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-600">newspaper</span>
        Produk
    </h1>

    <div class="mt-3">
        <a href="{{ route('admin.produk.create') }}" class="bg-emerald-600 text-white px-4 py-2 rounded inline-flex items-center gap-2">
            <span class="material-symbols-outlined">add</span>
            Tambah Produk
        </a>
    </div>

</div>

@if(session('success'))
    <div class="bg-emerald-100 text-emerald-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="mt-4 bg-white rounded shadow overflow-x-auto">
    <table class="w-full min-w-[720px]">
        <thead>
            <tr class="text-left bg-slate-700">
                <th class="p-3 text-slate-100">Gambar</th>
                <th class="p-3 text-slate-100">Judul</th>
                <th class="p-3 text-slate-100">Status</th>
                <th class="p-3 text-slate-100">Tanggal</th>
                <th class="p-3 text-slate-100">Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($produk as $item)
            <tr class="border-b hover:bg-emerald-50">
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
                    @if($item->published_at && $item->published_at <= now())
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-emerald-600 text-white">Published</span>
                    @else
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">Draft</span>
                    @endif
                </td>

                <td class="p-3 text-sm">{{ $item->published_at?->format('d M Y') ?? '-' }}</td>

                <td class="p-3">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.produk.edit', $item) }}" class="inline-flex items-center justify-center w-8 h-8 rounded hover:bg-emerald-50 text-emerald-600 border border-transparent hover:border-emerald-100" title="Edit">
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
@endsection
