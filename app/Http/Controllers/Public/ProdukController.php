<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        return view('public.produk.index', [
            'produk' => Produk::published()
                        ->latest('published_at')
                        ->paginate(6)
        ]);
    }

    public function show($slug)
    {
        $produk = Produk::published()
                    ->where('slug', $slug)
                    ->firstOrFail();

        return view('public.produk.show', compact('produk'));
    }
}
