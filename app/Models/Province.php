<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false; // tabel wilayah biasanya tanpa timestamps
    protected $fillable = ['name'];

    public function regencies()
    {
        return $this->hasMany(Regency::class, 'province_id', 'id');
    }
}
