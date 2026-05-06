@extends('admin.layout')

@section('title','Pages')

@section('content')
<div class="mb-2">
    <h1 class="text-2xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-600">description</span>
        Halaman Statis
    </h1>

    <div class="mt-3">
        <a href="{{ route('admin.pages.create') }}" class="bg-emerald-600 text-white px-4 py-2 rounded inline-flex items-center gap-2">
            <span class="material-symbols-outlined">add</span>
            Tambah Halaman
        </a>
    </div>

</div>

<div class="mt-4 bg-white rounded shadow overflow-x-auto">
    <table class="w-full min-w-[720px]">
        <thead>
            <tr class="text-left bg-slate-700">
                <th class="p-3 text-slate-100">Judul</th>
                <th class="p-3 text-slate-100">Slug</th>
                <th class="p-3 text-slate-100">Status</th>
                <th class="p-3 text-slate-100">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($pages as $page)
        <tr class="border-b hover:bg-emerald-50">
            <td class="p-3">{{ $page->title }}</td>
            <td class="p-3">{{ $page->slug }}</td>
            <td class="p-3">
                @if($page->is_active)
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-emerald-600 text-white">Aktif</span>
                @else
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">Nonaktif</span>
                @endif
            </td>
            <td class="p-3">
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.pages.edit',$page) }}" class="inline-flex items-center justify-center w-8 h-8 rounded hover:bg-emerald-50 text-emerald-600 border border-transparent hover:border-emerald-100" title="Edit">
                        <span class="material-symbols-outlined text-[18px]">edit</span>
                    </a>

                    <form method="POST" action="{{ route('admin.pages.destroy',$page) }}" onsubmit="return confirm('Hapus halaman?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded hover:bg-red-50 text-red-600 border border-transparent hover:border-red-100" title="Hapus">
                            <span class="material-symbols-outlined text-[18px]">delete</span>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
