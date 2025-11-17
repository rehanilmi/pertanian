<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use App\Models\Bidang;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $data = Pengumuman::with('bidang')->latest()->get();
        return view('admin.pengumuman.index', compact('data'));
    }

    public function create()
    {
        $bidang = Bidang::all();
        return view('admin.pengumuman.create', compact('bidang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'judul' => 'required|string|max:255',
            'isi' => 'nullable|string',
            'bidang_uuid' => 'nullable|uuid',
            'status' => 'required|string'
        ]);

        Pengumuman::create([
            'tanggal' => $request->tanggal,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'bidang_uuid' => $request->bidang_uuid,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan');
    }

    public function edit($uuid)
    {
        $data = Pengumuman::where('uuid', $uuid)->firstOrFail();
        $bidang = Bidang::all();

        return view('admin.pengumuman.edit', compact('data', 'bidang'));
    }

    public function update(Request $request, $uuid)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'judul' => 'required|string|max:255',
            'isi' => 'nullable|string',
            'bidang_uuid' => 'nullable|uuid',
            'status' => 'required|string'
        ]);

        $data = Pengumuman::where('uuid', $uuid)->firstOrFail();

        $data->update([
            'tanggal' => $request->tanggal,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'bidang_uuid' => $request->bidang_uuid,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        Pengumuman::where('uuid', $uuid)->delete();

        return back()->with('success', 'Pengumuman berhasil dihapus');
    }
}
