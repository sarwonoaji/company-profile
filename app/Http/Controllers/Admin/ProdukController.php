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
        ]);

         // upload foto
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = uniqid('produk_', true) . '.' . $file->extension();
            $destination = public_path('img/produk');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $data['image'] = $filename;
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
        ]);

          // upload image baru
    if ($request->file('image')) {

        // hapus image lama jika ada
        if ($produk->image) {
            $oldImage = public_path('img/produk/' . $produk->image);

            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        }

        // upload image baru
        $file = $request->file('image');
        $filename = uniqid('produk_', true) . '.' . $file->extension();
        $destination = public_path('img/produk');

        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $file->move($destination, $filename);

        $data['image'] = $filename;
    }

        $data['slug'] = Str::slug($data['title']);

        $produk->update($data);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Produk $produk)
    {
         // hapus image jika ada
        if ($produk->image) {
            $imagePath = public_path('img/produk/' . $produk->image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $produk->delete();

        return back()->with('success', 'Produk berhasil dihapus');
    }
}
