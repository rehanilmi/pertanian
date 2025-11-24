<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeedVariety;
use Illuminate\Http\Request;

class SeedVarietyController extends Controller
{
    public function index()
    {
        $varieties = SeedVariety::latest()->paginate(10);
        return view('admin.varieties.index', compact('varieties'));
    }

    public function create()
    {
        return view('admin.varieties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'nullable',
            'description' => 'nullable',
        ]);

        SeedVariety::create($request->all());

        return redirect()
            ->route('admin.varieties.index')
            ->with('success', 'Varietas benih berhasil ditambahkan.');
    }

    public function edit(SeedVariety $variety)
    {
        return view('admin.varieties.edit', compact('variety'));
    }

    public function update(Request $request, SeedVariety $variety)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $variety->update($request->all());

        return redirect()
            ->route('admin.varieties.index')
            ->with('success', 'Varietas benih berhasil diperbarui.');
    }

    public function destroy(SeedVariety $variety)
    {
        $variety->delete();

        return redirect()
            ->route('admin.varieties.index')
            ->with('success', 'Varietas benih berhasil dihapus.');
    }
}
