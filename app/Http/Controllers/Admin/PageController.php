<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.pages.index', [
            'pages' => Page::latest()->get()
        ]);
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required',
            'slug'             => 'required|unique:pages,slug',
            'content'          => 'required',
            'meta_title'       => 'nullable',
            'meta_description' => 'nullable',
            'is_active'        => 'boolean',
        ]);

        // Ensure checkbox absence becomes false
        $data['is_active'] = $request->boolean('is_active');

        Page::create($data);

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Halaman berhasil dibuat');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'title'            => 'required',
            'slug'             => 'required|unique:pages,slug,' . $page->id,
            'content'          => 'required',
            'meta_title'       => 'nullable',
            'meta_description' => 'nullable',
            'is_active'        => 'boolean',
        ]);

        // Ensure checkbox absence becomes false
        $data['is_active'] = $request->boolean('is_active');

        $page->update($data);

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Halaman diperbarui');
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return back()->with('success', 'Halaman dihapus');
    }
}
