@extends('admin.layout')

@section('title','Banner')

@section('content')
<div class="mb-2">
    <h1 class="text-2xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined text-blue-600">view_list</span>
        Banner
    </h1>

    <div class="mt-3">
        <a href="{{ route('admin.banners.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded inline-flex items-center gap-2">
            <span class="material-symbols-outlined">add</span>
            Tambah Banner
        </a>
    </div>

</div>

<div class="mt-4 bg-white rounded shadow overflow-x-auto">
    <table class="w-full min-w-[720px]">
        <thead>
            <tr class="text-left bg-slate-700">
                <th class="p-3 text-slate-100">Judul</th>
                <th class="p-3 text-slate-100">Deskripsi</th>
                <th class="p-3 text-slate-100">Image</th>
                <th class="p-3 text-slate-100">Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach($banners as $banner)
            <tr class="border-b hover:bg-blue-50">
                <td class="p-3">{{ $banner->judul }}</td>
                <td class="p-3">{{ $banner->deskripsi }}</td>
                <td class="p-3">
                    @if($banner->image)
                        <img src="{{ asset('img/banners/' . $banner->image) }}" alt="{{ $banner->judul }}" class="w-16 h-16 object-cover rounded">
                    @endif
                </td>
                <td class="p-3">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.banners.edit', $banner) }}" class="inline-flex items-center justify-center w-8 h-8 rounded hover:bg-blue-50 text-blue-600 border border-transparent hover:border-blue-100" title="Edit">
                            <span class="material-symbols-outlined text-[18px]">edit</span>
                        </a>

                        <!-- <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" onsubmit="return confirm('Hapus banner ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded hover:bg-red-50 text-red-600 border border-transparent hover:border-red-100" title="Hapus">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>
                        </form> -->
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
