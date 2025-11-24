<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Supplier extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'supplier_type_id',
        'phone',
        'email',
        'address',
        'district_id',
        'village_id',
        'latitude',
        'longitude',
        'creator_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (! $model->id) {
                $model->id = Str::uuid()->toString();
            }
            if (auth()->check()) {
                $model->creator_id = auth()->id();
            }
        });
    }

    public function type()
    {
        return $this->belongsTo(SupplierType::class, 'supplier_type_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id', 'id');
    }

    public function stocks()
    {
        return $this->hasMany(SupplierStock::class, 'supplier_id');
    }

}
