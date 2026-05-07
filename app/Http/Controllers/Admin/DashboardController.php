<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingSection;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Produk;

use App\Models\Pekerjaan;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalNews'        => Produk::count(),
            'publishedNews'    => Produk::published()->count(),
            'landingSections'  => LandingSection::count(),
            'pages'            => Page::count(),
            'setting'          => Setting::first(),
        ]);
    }
}
