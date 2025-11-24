<?php

namespace App\Http\Controllers;

use App\Models\Supplier;

class PerbenihanController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::with([
            'type',
            'village',
            'district',
            'district.regency',
            'stocks.variety'
        ])->get();

        return view('perbenihan.index', compact('suppliers'));
    }

}
