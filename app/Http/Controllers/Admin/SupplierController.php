<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\SupplierType;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::with([
            'type',
            'village.district.regency.province'
        ])->latest()->paginate(10);

        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        $types = SupplierType::all();

        $provinces = Province::orderBy('name')->get();
        $regencies = Regency::orderBy('name')->get();
        $districts = District::orderBy('name')->get();

        return view('admin.suppliers.create', compact(
            'types',
            'provinces',
            'regencies',
            'districts'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required',
            'supplier_type_id'  => 'required',
            'province_id'       => 'required',
            'regency_id'        => 'required',
            'district_id'       => 'required',
            'village_id'        => 'required',
            'latitude'          => 'nullable|numeric',
            'longitude'         => 'nullable|numeric',
        ]);

        Supplier::create([
            'name' => $request->name,
            'supplier_type_id' => $request->supplier_type_id,
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'creator_id' => auth()->id(),
        ]);

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function edit(Supplier $supplier)
    {
        $types = SupplierType::all();
        $provinces = Province::orderBy('name')->get();

        // ambil kabupaten berdasarkan provinsi supplier
        $regencies = Regency::where('province_id', $supplier->district->regency->province_id)->get();

        // ambil kecamatan berdasarkan kabupaten
        $districts = District::where('regency_id', $supplier->district->regency_id)->get();

        // ambil desa berdasarkan kecamatan
        $villages = Village::where('district_id', $supplier->district_id)->get();

        return view('admin.suppliers.edit', compact(
            'supplier',
            'types',
            'provinces',
            'regencies',
            'districts',
            'villages'
        ));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name'              => 'required',
            'supplier_type_id'  => 'required',
            'province_id'       => 'required',
            'regency_id'        => 'required',
            'district_id'       => 'required',
            'village_id'        => 'required',
            'latitude'          => 'nullable|numeric',
            'longitude'         => 'nullable|numeric',
        ]);

        $supplier->update([
            'name' => $request->name,
            'supplier_type_id' => $request->supplier_type_id,
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier berhasil dihapus.');
    }
}
