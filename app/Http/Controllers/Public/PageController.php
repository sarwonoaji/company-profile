<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)
                    ->active()
                    ->firstOrFail();
        return view('public.page', compact('page'));
    }

    public function profil()
    {
        return $this->page('profil');
    }

    public function visiMisi()
    {
        return $this->page('visi-misi');
    }

    public function kontak()
    {
        return $this->page('kontak');
    }

    private function page($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('public.page', compact('page'));
    }
}
