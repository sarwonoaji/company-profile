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

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('landing', 'public');
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

        if ($request->hasFile('image')) {

            if ($landingSection->image) {
                Storage::disk('public')->delete($landingSection->image);
            }

            $data['image'] = $request->file('image')
                ->store('landing', 'public');
        }

        $landingSection->update($data);

        return redirect()
            ->route('admin.landing-sections.index')
            ->with('success', 'Landing section berhasil diperbarui');
    }

    public function destroy(LandingSection $landingSection)
    {
        if ($landingSection->image) {
            Storage::disk('public')->delete($landingSection->image);
        }

        $landingSection->delete();

        return back()->with('success', 'Landing section berhasil dihapus');
    }
}
