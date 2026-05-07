@extends('admin.layout')

@section('title','Edit Pengaturan Situs')
@section('content')
<div class="py-8">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-xl font-bold flex items-center gap-2">
                    <span class="material-symbols-outlined text-emerald-600">edit</span>
                    Edit Pengaturan Situs
                </h1>
           </div>

            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label for="site_name" class="block text-sm font-medium text-slate-600 mb-1">Nama Situs <span class="text-red-500">*</span></label>
                    <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $setting->site_name ?? '') }}" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300 @error('site_name') border-red-500 @enderror">
                    @error('site_name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="logo" class="block text-sm font-medium text-slate-600 mb-1">Logo</label>
                    @if($setting && $setting->logo)
                    <div class="mb-3">
                        <p class="text-sm text-slate-600 mb-2">Logo saat ini:</p>
                        <div class="max-w-xs">
                            <img src="{{ asset('img/logo/'.$setting->logo) }}" alt="Logo" class="w-full h-auto rounded-lg shadow">
                        </div>
                    </div>
                    @endif
                    <input type="file" name="logo" id="logo" accept="image/*" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300 @error('logo') border-red-500 @enderror">
                    <p class="mt-1 text-xs text-slate-500">Format: JPEG, PNG, GIF, WebP (Max 2MB)</p>
                    @error('logo')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-slate-600 mb-1">Alamat</label>
                    <textarea name="address" id="address" rows="3" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300 @error('address') border-red-500 @enderror">{{ old('address', $setting->address ?? '') }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-slate-600 mb-1">Nomor Telepon</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $setting->phone ?? '') }}" placeholder="+62..." class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300 @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-600 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $setting->email ?? '') }}" placeholder="email@example.com" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="border-t pt-4">
                    <h3 class="text-sm font-semibold text-slate-700 mb-3">Media Sosial</h3>

                    <div class="space-y-3">
                        <div>
                            <label for="facebook" class="block text-sm text-slate-600 mb-1">Facebook</label>
                            <input type="url" name="facebook" id="facebook" value="{{ old('facebook', $setting->facebook ?? '') }}" placeholder="https://facebook.com/..." class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300 @error('facebook') border-red-500 @enderror">
                            @error('facebook')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="instagram" class="block text-sm text-slate-600 mb-1">Instagram</label>
                            <input type="url" name="instagram" id="instagram" value="{{ old('instagram', $setting->instagram ?? '') }}" placeholder="https://instagram.com/..." class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300 @error('instagram') border-red-500 @enderror">
                            @error('instagram')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="youtube" class="block text-sm text-slate-600 mb-1">YouTube</label>
                            <input type="url" name="youtube" id="youtube" value="{{ old('youtube', $setting->youtube ?? '') }}" placeholder="https://youtube.com/..." class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300 @error('youtube') border-red-500 @enderror">
                            @error('youtube')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex gap-2 pt-4 border-t">
                    <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded inline-flex items-center gap-2">
                        <span class="material-symbols-outlined">save</span>
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('admin.settings.index') }}" class="px-4 py-2 rounded border border-slate-200 text-slate-700 inline-flex items-center gap-2 hover:bg-slate-50">
                        <span class="material-symbols-outlined">arrow_back</span>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
