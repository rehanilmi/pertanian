<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SupplierTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'UPT',
            'Produsen Benih',
            'Distributor',
            'Kelompok Tani',
            'Lainnya'
        ];

        foreach ($types as $name) {
            DB::table('supplier_types')->insert([
                'id' => (string) Str::uuid(),
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
