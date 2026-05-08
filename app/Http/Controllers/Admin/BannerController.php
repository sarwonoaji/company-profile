<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
     public function index()
    {
        return view('admin.banners.index', [
            'banners' => Banner::latest()->get()
        ]);
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'image'     => 'nullable|image|max:2048',
        ]);


         // upload foto
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = uniqid('banner_', true) . '.' . $file->extension();
            $destination = public_path('img/banners');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $data['image'] = $filename;
        }

        Banner::create($data);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner berhasil ditambahkan');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $data = $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'image'     => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        // Ensure checkbox absence becomes false when unchecked
        $data['is_active'] = $request->boolean('is_active');

                // upload image baru
        if ($request->file('image')) {

            // hapus image lama jika ada
            if ($banner->image) {
                $oldImage = public_path('img/banners/' . $banner->image);

                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            // upload image baru
            $file = $request->file('image');
            $filename = uniqid('banner_', true) . '.' . $file->extension();
            $destination = public_path('img/banners');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);

            $data['image'] = $filename;
        }

        $banner->update($data);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner berhasil diperbarui');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image) {
            $imagePath = public_path('img/banners/' . $banner->image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $banner->delete();

        return back()->with('success', 'Banner berhasil dihapus');
    }
}
