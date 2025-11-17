<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\BeritaImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaAdminController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->paginate(10);
        return view('admin.berita.index', compact('beritas'));
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
        ]);

        $berita = Berita::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul) . '-' . Str::random(6),
            'isi' => $request->isi,
        ]);

        return redirect()->route('admin.berita.edit', $berita->id)
            ->with('success', 'Berita berhasil dibuat, silakan upload gambar.');
    }

    public function edit($id)
    {
        $berita = Berita::with('images')->findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
        ]);

        $berita->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul) . '-' . Str::random(6),
            'isi' => $request->isi,
        ]);

        // FIX: setelah edit, balik ke index
        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    // UPLOAD GAMBAR KHUSUS
    public function addImage(Request $request, $id)
    {
        $request->validate([
            'gambar.*' => 'required|image|mimes:jpg,jpeg,png'
        ]);

        foreach ($request->file('gambar') as $img) {
            $path = $img->store('berita', 'public');

            BeritaImage::create([
                'berita_id' => $id,
                'gambar' => $path
            ]);
        }

        return back()->with('success', 'Gambar berhasil ditambahkan!');
    }

    public function deleteImage($id)
    {
        $image = BeritaImage::findOrFail($id);
        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus!');
    }

    public function destroy($id)
    {
        Berita::findOrFail($id)->delete();
        return back()->with('success', 'Berita berhasil dihapus!');
    }
}
