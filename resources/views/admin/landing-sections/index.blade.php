@extends('admin.layout')

@section('title','Landing Sections')

@section('content')
<div class="mb-2">
    <h1 class="text-2xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined text-blue-600">view_list</span>
        Landing Page Sections
    </h1>

    <div class="mt-3">
        <a href="{{ route('admin.landing-sections.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded inline-flex items-center gap-2">
            <span class="material-symbols-outlined">add</span>
            Tambah Section
        </a>
    </div>

</div>

<div class="mt-4 bg-white rounded shadow overflow-x-auto">
    <table class="w-full min-w-[720px]">
        <thead>
            <tr class="text-left bg-slate-700">
                <th class="p-3 text-slate-100">Key</th>
                <th class="p-3 text-slate-100">Judul</th>
                <th class="p-3 text-slate-100">Order</th>
                <th class="p-3 text-slate-100">Status</th>
                <th class="p-3 text-slate-100">Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach($sections as $section)
            <tr class="border-b hover:bg-blue-50">
                <td class="p-3">{{ $section->key }}</td>
                <td class="p-3">{{ $section->title }}</td>
                <td class="p-3">{{ $section->order }}</td>
                <td class="p-3">
                    @if($section->is_active)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-blue-600 text-white">Aktif</span>
                    @else
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-600">Nonaktif</span>
                    @endif
                </td>
                <td class="p-3">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.landing-sections.edit', $section) }}" class="inline-flex items-center justify-center w-8 h-8 rounded hover:bg-blue-50 text-blue-600 border border-transparent hover:border-blue-100" title="Edit">
                            <span class="material-symbols-outlined text-[18px]">edit</span>
                        </a>

                        <form action="{{ route('admin.landing-sections.destroy', $section) }}" method="POST" onsubmit="return confirm('Hapus section ini?')">
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
