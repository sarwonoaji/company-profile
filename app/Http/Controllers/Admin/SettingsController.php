<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends \Illuminate\Routing\Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.settings.index', compact('setting'));
    }

    public function edit()
    {
        $setting = Setting::firstOrCreate(
            ['id' => 1],
            [
                'site_name' => '',
                'phone' => '',
                'email' => '',
                'address' => '',
                'facebook' => '',
                'instagram' => '',
                'youtube' => '',
            ]
        );
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,gif,webp|max:2048',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
        ]);

        $setting = Setting::firstOrCreate(['id' => 1]);

                // Handle logo upload
                    // upload image baru
            if ($request->file('logo')) {

                // hapus image lama jika ada
                if ($setting->logo) {
                    $oldImage = public_path('img/logo/' . $setting->logo);

                    if (file_exists($oldImage)) {
                        unlink($oldImage);
                    }
                }

                // upload image baru
                $file = $request->file('logo');
                $filename = uniqid('logo_', true) . '.' . $file->extension();
                $destination = public_path('img/logo');

                if (!file_exists($destination)) {
                    mkdir($destination, 0755, true);
                }

                $file->move($destination, $filename);

                $validated['logo'] = $filename;
            }

        $setting->update($validated);

        return redirect()->route('admin.settings.index')
                       ->with('success', 'Pengaturan berhasil diperbarui');
    }
}
