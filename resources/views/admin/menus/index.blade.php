@extends('admin.layout')

@section('title','Menu')

@section('content')
<div class="mb-2">
    <h1 class="text-2xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined text-blue-600">menu</span>
        Kelola Menu Navbar
    </h1>

    <div class="mt-3">
        <a href="{{ route('admin.menus.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded inline-flex items-center gap-2">
            <span class="material-symbols-outlined">add</span>
            Tambah Menu
        </a>
    </div>

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
                <th class="p-3 text-slate-100">Urutan</th>
                <th class="p-3 text-slate-100">Judul Menu</th>
                <th class="p-3 text-slate-100">URL</th>
                <th class="p-3 text-slate-100">Status</th>
                <th class="p-3 text-slate-100">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($menus as $menu)
            <tr class="border-b hover:bg-blue-50">
                <td class="p-3 text-center font-semibold">{{ $menu->order ?? '-' }}</td>
                <td class="p-3">{{ $menu->title }}</td>
                <td class="p-3 text-sm text-gray-600">{{ $menu->url }}</td>
                <td class="p-3">
                    @if($menu->is_active)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-blue-600 text-white">Aktif</span>
                    @else
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">Nonaktif</span>
                    @endif
                </td>
                <td class="p-3">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.menus.edit', $menu) }}" class="inline-flex items-center justify-center w-8 h-8 rounded hover:bg-blue-50 text-blue-600 border border-transparent hover:border-blue-100" title="Edit">
                            <span class="material-symbols-outlined text-[18px]">edit</span>
                        </a>

                        <form method="POST" action="{{ route('admin.menus.destroy', $menu) }}" onsubmit="return confirm('Hapus menu ini?')">
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
                <td colspan="5" class="p-6 text-center text-gray-500">Belum ada menu</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
