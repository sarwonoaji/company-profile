<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function index()
    {
        return view('admin.produk.index', [
            'produk' => Produk::latest()->get()
        ]);
    }

    public function create()
    {
        return view('admin.produk.create');
    }

    public function show(Produk $produk)
    {
        return view('admin.produk.show', compact('produk'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'excerpt'          => 'nullable|string',
            'content'          => 'required|string',
            'link'             => 'required|string',
            'image'            => 'nullable|image|max:2048',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'published_at'     => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('produk', 'public');
        }

        $data['user_id'] = Auth::id();
        $data['slug']    = Str::slug($data['title']);

        Produk::create($data);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Produk $produk)
    {
        return view('admin.produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'excerpt'          => 'nullable|string',
            'content'          => 'required|string',
            'link'             => 'required|string',
            'image'            => 'nullable|image|max:2048',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'published_at'     => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            if ($produk->image) {
                Storage::disk('public')->delete($produk->image);
            }

            $data['image'] = $request->file('image')
                ->store('produk', 'public');
        }

        $data['slug'] = Str::slug($data['title']);

        $produk->update($data);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->image) {
            Storage::disk('public')->delete($produk->image);
        }

        $produk->delete();

        return back()->with('success', 'Produk berhasil dihapus');
    }
}
