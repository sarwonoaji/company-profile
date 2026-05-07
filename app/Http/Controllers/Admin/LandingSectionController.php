<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingSectionController extends Controller
{
    public function index()
    {
        return view('admin.landing-sections.index', [
            'sections' => LandingSection::orderBy('order')->get()
        ]);
    }

    public function create()
    {
        return view('admin.landing-sections.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'key'       => 'required|string|max:50',
            'title'     => 'nullable|string',
            'content'   => 'nullable|string',
            'order'     => 'required|integer',
            'image'     => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        // Ensure checkbox absence becomes false
        $data['is_active'] = $request->boolean('is_active');

         // upload foto
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = uniqid('landing_', true) . '.' . $file->extension();
            $destination = public_path('img/landing');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $data['image'] = $filename;
        }

        LandingSection::create($data);

        return redirect()
            ->route('admin.landing-sections.index')
            ->with('success', 'Landing section berhasil ditambahkan');
    }

    public function edit(LandingSection $landingSection)
    {
        return view('admin.landing-sections.edit', compact('landingSection'));
    }

    public function update(Request $request, LandingSection $landingSection)
    {
        $data = $request->validate([
            'key'       => 'required|string|max:50',
            'title'     => 'nullable|string',
            'content'   => 'nullable|string',
            'order'     => 'required|integer',
            'image'     => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        // Ensure checkbox absence becomes false when unchecked
        $data['is_active'] = $request->boolean('is_active');

                // upload image baru
        if ($request->file('image')) {

            // hapus image lama jika ada
            if ($landingSection->image) {
                $oldImage = public_path('img/landing/' . $landingSection->image);

                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            // upload image baru
            $file = $request->file('image');
            $filename = uniqid('landing_', true) . '.' . $file->extension();
            $destination = public_path('img/landing');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);

            $data['image'] = $filename;
        }

        $landingSection->update($data);

        return redirect()
            ->route('admin.landing-sections.index')
            ->with('success', 'Landing section berhasil diperbarui');
    }

    public function destroy(LandingSection $landingSection)
    {
        if ($landingSection->image) {
            $imagePath = public_path('img/landing/' . $landingSection->image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $landingSection->delete();

        return back()->with('success', 'Landing section berhasil dihapus');
    }
}
