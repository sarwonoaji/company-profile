@extends('admin.layout')

@section('title', 'Profile')

@section('page-title')
    <h1 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-600">person</span>
        Profile
    </h1>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Informasi Profile</h2>
            <p class="text-gray-600 mt-1">Kelola informasi akun Anda</p>
        </div>

        <div class="p-6">
            <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- Profile Picture -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profile</label>
                    <div class="flex items-center gap-4">
                        <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center">
                            @if(auth()->user()->profile_photo_path)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Profile" class="w-20 h-20 rounded-full object-cover">
                            @else
                                <span class="text-2xl text-emerald-600 font-semibold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            @endif
                        </div>
                        <div>
                            <input type="file" name="profile_photo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                            <p class="text-xs text-gray-500 mt-1">JPG, PNG atau GIF. Maksimal 2MB.</p>
                        </div>
                    </div>
                </div>

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Password (for verification) -->
                <div class="mb-4">
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                    <input type="password" name="current_password" id="current_password"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <p class="text-xs text-gray-500 mt-1">Diperlukan untuk mengubah password atau email</p>
                    @error('current_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru (Opsional)</label>
                    <input type="password" name="password" id="password"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <div>
                        @if (session('status') === 'profile-updated')
                            <p class="text-sm text-green-600 font-medium">Profile berhasil diperbarui.</p>
                        @endif
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('admin.dashboard') }}"
                           class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Account Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mt-6">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-red-600">Hapus Akun</h2>
            <p class="text-gray-600 mt-1">Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen.</p>
        </div>

        <div class="p-6">
            <form method="POST" action="{{ route('admin.profile.destroy') }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan.')">
                @csrf
                @method('DELETE')

                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                    Hapus Akun
                </button>
            </form>
        </div>
    </div>
</div>
@endsection