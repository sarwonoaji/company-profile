@extends('public.layout')

@section('title', $page->meta_title ?? $page->title)

@section('content')

@php
    function renderContent($content)
    {
        libxml_use_internal_errors(true);

        $content = html_entity_decode(trim($content));

        $dom = new DOMDocument('1.0', 'UTF-8');

        $dom->loadHTML(
            mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'),
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );

        $xpath = new DOMXPath($dom);
        $zoom = 15;

        // Cari <figure class="media">
        $figures = $xpath->query('//figure[contains(@class,"media")]');

        foreach ($figures as $figure) {

            $oembed = $figure->getElementsByTagName('oembed')->item(0);

            if (!$oembed) {
                continue;
            }

            $url = $oembed->getAttribute('url');

            // Pastikan Google Maps
            if (!str_contains($url, 'google.com/maps')) {
                continue;
            }

            $lat = null;
            $lng = null;

            // Ambil koordinat
            if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $url, $m)) {
                $lat = $m[1];
                $lng = $m[2];
            }

            // Buat iframe
            $iframe = $dom->createElement('iframe');

            $iframe->setAttribute(
                'src',
                $lat && $lng
                    ? "https://www.google.com/maps?q={$lat},{$lng}&z={$zoom}&output=embed"
                    : "https://www.google.com/maps?q=" . urlencode($url) . "&output=embed"
            );

            $iframe->setAttribute('width', '100%');
            $iframe->setAttribute('height', '450');
            $iframe->setAttribute('style', 'border:0;');
            $iframe->setAttribute('loading', 'lazy');
            $iframe->setAttribute('allowfullscreen', '');

            // Wrapper iframe
            $wrapper = $dom->createElement('div');
            $wrapper->setAttribute('class', 'not-prose space-y-4');

            $wrapper->appendChild($iframe);

            // Tombol rute
            if ($lat && $lng) {

                $a = $dom->createElement('a', 'Rute ke Lokasi');

                $a->setAttribute(
                    'href',
                    "https://www.google.com/maps/dir/?api=1&destination={$lat},{$lng}"
                );

                $a->setAttribute('target', '_blank');

                $a->setAttribute(
                    'class',
                    'inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition'
                );

                $wrapper->appendChild($a);
            }

            // Replace figure dengan iframe
            $figure->parentNode->replaceChild($wrapper, $figure);
        }

        // Ambil isi body saja
        $body = $dom->getElementsByTagName('body')->item(0);

        $result = '';

        if ($body) {
            foreach ($body->childNodes as $child) {
                $result .= $dom->saveHTML($child);
            }
        } else {
            $result = $dom->saveHTML();
        }

        return $result;
    }
@endphp

{{-- BREADCRUMB --}}
<div class="bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200 py-6">
    <div class="container mx-auto px-4">

        <div class="flex items-center text-sm text-gray-600 space-x-2">

            <a href="{{ route('landing') }}"
               class="hover:text-blue-600 transition-colors flex items-center gap-1">

                <svg class="w-4 h-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 12l2.83-2.83a1 1 0 011.41 0L12 12m0 0l3.76-3.76a1 1 0 011.41 0L21 12M5 6h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z">
                    </path>

                </svg>

                Beranda
            </a>

            <span class="text-gray-400">/</span>

            <span class="text-gray-900 font-semibold">
                {{ $page->title }}
            </span>

        </div>
    </div>
</div>

{{-- CONTENT --}}
<div class="container mx-auto py-20 px-4">

    <article class="max-w-3xl mx-auto" data-aos="fade-up">

        <div class="mb-12">

            <h1 class="text-5xl font-bold mb-4 text-blue-600">
                {{ $page->title }}
            </h1>

            <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-blue-600"></div>

        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12"
             data-aos="fade-up"
             data-aos-delay="100">

            <div class="prose prose-lg max-w-none">

                {!! renderContent($page->content) !!}

            </div>

        </div>

        {{-- BACK BUTTON --}}
        <div class="mt-12 flex justify-center"
             data-aos="fade-up"
             data-aos-delay="200">

            <a href="javascript:history.back()"
               class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold transition-colors">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>

                </svg>

                Kembali

            </a>

        </div>

    </article>

</div>

@endsection