@extends('admin.layout')

@section('title','Pengaturan Situs')
@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-xl font-bold flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-600">settings</span>
                Pengaturan Situs
            </h1>
            <a href="{{ route('admin.settings.edit') }}" class="inline-flex items-center px-3 py-2 bg-emerald-600 rounded text-sm text-white hover:bg-emerald-700">
                <span class="material-symbols-outlined mr-2">edit</span>
                Edit Pengaturan
            </a>
        </div>

        @if($setting)
        <div class="bg-white p-4 rounded shadow">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Logo --}}
                @if($setting->logo)
                <div class="col-span-full">
                    <label class="block text-sm font-medium text-slate-600 mb-2">Logo Situs</label>
                    <div class="max-w-xs">
                        <img src="{{ asset('img/logo/' . $setting->logo) }}" alt="Logo" class="w-full h-auto rounded-lg shadow">
                    </div>
                </div>
                @endif

                {{-- Site Name --}}
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">Nama Situs</label>
                    <div class="px-3 py-2 bg-slate-50 border border-slate-200 rounded">
                        <p class="text-slate-900 font-semibold">{{ $setting->site_name }}</p>
                    </div>
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">Email</label>
                    <div class="px-3 py-2 bg-slate-50 border border-slate-200 rounded">
                        <p class="text-slate-900">{{ $setting->email ?? '-' }}</p>
                    </div>
                </div>

                {{-- Phone --}}
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">Nomor Telepon</label>
                    <div class="px-3 py-2 bg-slate-50 border border-slate-200 rounded">
                        <p class="text-slate-900">{{ $setting->phone ?? '-' }}</p>
                    </div>
                </div>

                {{-- Address --}}
                <div class="col-span-full">
                    <label class="block text-sm font-medium text-slate-600 mb-1">Alamat</label>
                    <div class="px-3 py-2 bg-slate-50 border border-slate-200 rounded">
                        <p class="text-slate-900">{{ $setting->address ?? '-' }}</p>
                    </div>
                </div>

                {{-- Social Media --}}
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">Facebook</label>
                    <div class="px-3 py-2 bg-slate-50 border border-slate-200 rounded">
                        @if($setting->facebook)
                            <a href="{{ $setting->facebook }}" target="_blank" class="text-emerald-600 hover:text-emerald-700 break-all">{{ $setting->facebook }}</a>
                        @else
                            <p class="text-slate-500">-</p>
                        @endif
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">Instagram</label>
                    <div class="px-3 py-2 bg-slate-50 border border-slate-200 rounded">
                        @if($setting->instagram)
                            <a href="{{ $setting->instagram }}" target="_blank" class="text-emerald-600 hover:text-emerald-700 break-all">{{ $setting->instagram }}</a>
                        @else
                            <p class="text-slate-500">-</p>
                        @endif
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">YouTube</label>
                    <div class="px-3 py-2 bg-slate-50 border border-slate-200 rounded">
                        @if($setting->youtube)
                            <a href="{{ $setting->youtube }}" target="_blank" class="text-emerald-600 hover:text-emerald-700 break-all">{{ $setting->youtube }}</a>
                        @else
                            <p class="text-slate-500">-</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="bg-white p-6 rounded shadow text-center">
            <p class="text-slate-500 mb-4">Belum ada pengaturan. Silakan buat pengaturan baru.</p>
            <a href="{{ route('admin.settings.edit') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded text-sm hover:bg-emerald-700">
                <span class="material-symbols-outlined mr-2">add</span>
                Buat Pengaturan
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
