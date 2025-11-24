<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\SupplierStock;
use App\Models\SupplierStockLog;
use App\Models\SeedVariety;
use Illuminate\Http\Request;

class SupplierStockController extends Controller
{
    public function index()
    {
        $stocks = SupplierStock::with(['supplier', 'variety'])
            ->latest()
            ->paginate(10);

        return view('admin.supplier_stocks.index', compact('stocks'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('name')->get();
        $varieties = SeedVariety::orderBy('name')->get();

        return view('admin.supplier_stocks.create', compact('suppliers', 'varieties'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'supplier_id' => 'required',
            'variety_id' => 'required',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required',
            'price' => 'nullable|integer|min:0',
            'stock_date' => 'nullable|date',
        ]);

        SupplierStock::create($req->all());

        return redirect()->route('admin.supplier_stocks.index')
            ->with('success', 'Stok berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $stock = SupplierStock::findOrFail($id);
        $suppliers = Supplier::orderBy('name')->get();
        $varieties = SeedVariety::orderBy('name')->get();

        return view('admin.supplier_stocks.edit', compact('stock', 'suppliers', 'varieties'));
    }

    public function update(Request $req, $id)
    {
        $req->validate([
            'supplier_id' => 'required',
            'variety_id' => 'required',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required',
            'price' => 'nullable|integer|min:0',
            'stock_date' => 'nullable|date',
        ]);

        SupplierStock::findOrFail($id)->update($req->all());

        return redirect()->route('admin.supplier_stocks.index')
            ->with('success', 'Stok berhasil diperbarui.');
    }

    public function destroy($id)
    {
        SupplierStock::findOrFail($id)->delete();

        return redirect()->route('admin.supplier_stocks.index')
            ->with('success', 'Stok berhasil dihapus.');
    }

    public function updateStock(Request $request)
    {
        $validated = $request->validate([
            'supplier_stock_id' => 'required|exists:supplier_stocks,id',
            'change_type' => 'required|in:IN,OUT',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        // Ambil stok lama
        $stock = SupplierStock::findOrFail($request->supplier_stock_id);
        $stokSebelumnya = $stock->quantity;

        // Hitung stok baru
        if ($request->change_type === 'IN') {
            $stokBaru = $stokSebelumnya + $request->quantity;
        } else {
            $stokBaru = max(0, $stokSebelumnya - $request->quantity);
        }

        // SIMPAN LOG (termasuk created_by)
        SupplierStockLog::create([
            'supplier_stock_id' => $stock->id,
            'change_type'        => $request->change_type,
            'quantity'           => $request->quantity,
            'note'               => $request->note,
            'created_by'         => auth()->id(),
        ]);

        // UPDATE STOK UTAMA
        $stock->update([
            'quantity' => $stokBaru
        ]);

        return back()->with('success', 'Stok berhasil diperbarui.');
    }

    public function logs(Request $request)
    {
        $stockId = $request->supplier_stock_id; // ID dari supplier_stocks

        // List stok yang tampil di dropdown
        $stocks = SupplierStock::with(['supplier', 'variety'])
            ->orderBy('created_at', 'desc')
            ->get();

        $logs = collect([]);

        if ($stockId) {
            $logs = SupplierStockLog::where('supplier_stock_id', $stockId)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }

        return view('admin.supplier_stocks.logs', compact('stocks', 'logs', 'stockId'));
    }


}
