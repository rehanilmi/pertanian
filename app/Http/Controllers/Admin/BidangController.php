<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    // LIST
    public function index()
    {
        $data = Bidang::latest()->get();
        return view('admin.bidang.index', compact('data'));
    }

    // FORM CREATE
    public function create()
    {
        return view('admin.bidang.create');
    }

    // STORE DATA
    public function store(Request $request)
    {
        $request->validate([
            'bidang' => 'required|string|max:255',
            'struktur_organisasi' => 'nullable|string'
        ]);

        Bidang::create([
            'bidang' => $request->bidang,
            'struktur_organisasi' => $request->struktur_organisasi,
        ]);

        return redirect()->route('admin.bidang.index')
            ->with('success', 'Data Bidang berhasil ditambahkan.');
    }

    // FORM EDIT
    public function edit($uuid)
    {
        $data = Bidang::where('uuid', $uuid)->firstOrFail();
        return view('admin.bidang.edit', compact('data'));
    }

    // UPDATE DATA
    public function update(Request $request, $uuid)
    {
        $request->validate([
            'bidang' => 'required|string|max:255',
            'struktur_organisasi' => 'nullable|string'
        ]);

        $data = Bidang::where('uuid', $uuid)->firstOrFail();

        $data->update([
            'bidang' => $request->bidang,
            'struktur_organisasi' => $request->struktur_organisasi,
        ]);

        return redirect()->route('admin.bidang.index')
            ->with('success', 'Data Bidang berhasil diperbarui.');
    }

    // DELETE DATA
    public function destroy($uuid)
    {
        $data = Bidang::where('uuid', $uuid)->firstOrFail();
        $data->delete();

        return back()->with('success', 'Data Bidang berhasil dihapus.');
    }
}
