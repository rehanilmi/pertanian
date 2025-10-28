<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Str;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->paginate(6);
        return view('berita.index', compact('beritas'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        return view('berita.show', compact('berita'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        $path = $request->file('gambar')?->store('berita', 'public');

        Berita::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'isi' => $request->isi,
            'gambar' => $path,
        ]);

        return redirect()->back()->with('success', 'Berita berhasil disimpan!');
    }

    public function home()
    {
        $beritaUtama = Berita::latest()->first();
        $arsipBerita = Berita::latest()->skip(1)->take(4)->get();
        $beritas = Berita::latest()->take(3)->get(); // buat bagian bawah lainnya

        return view('home', compact('beritaUtama', 'arsipBerita', 'beritas'));
    }

}

