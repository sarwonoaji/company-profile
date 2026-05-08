<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\LandingSection;
use App\Models\Produk;
use App\Models\Setting;
use App\Models\Banner;

class LandingController extends Controller
{
    public function index()
    {
        return view('public.landing', [
            'sections' => LandingSection::active()->get(),
            'latestNews' => Produk::published()
                                ->latest('created_at')
                                ->limit(6)
                                ->get(),
            'settings' => Setting::first(),
            'banners' => Banner::first(),
        ]);
    }
}
