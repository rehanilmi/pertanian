<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\PejabatStruktural;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    // ==========================
    //  HALAMAN BERANDA
    // ==========================
    public function home()
    {
        return view('home', [
            'beritaTerbaru' => Berita::latest()->take(2)->get(),
            'arsipBerita'   => Berita::latest()->skip(2)->take(5)->get(),
            'pengumuman' => Pengumuman::latest()->take(5)->get() ?? [],
            'kepalaDinas' => PejabatStruktural::first() ?? null,
            'stat' => (object)[
                'today' => 32,
                'month' => 1120,
                'total' => 98231,
            ]
        ]);
    }

    // ==========================
    //  HALAMAN LIST BERITA
    // ==========================
    public function index()
    {
        $beritas = Berita::latest()->paginate(6);
        return view('berita.index', compact('beritas'));
    }

    // ==========================
    //  HALAMAN DETAIL BERITA
    // ==========================
    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        return view('berita.show', compact('berita'));
    }
}
