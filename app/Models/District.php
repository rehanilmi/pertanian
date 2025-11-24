<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $timestamps = false;
    protected $fillable = ['regency_id', 'name'];

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'regency_id', 'id');
    }

    public function villages()
    {
        return $this->hasMany(Village::class, 'district_id', 'id');
    }
}
