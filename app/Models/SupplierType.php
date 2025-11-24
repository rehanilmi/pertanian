<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SupplierType extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['name'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (! $model->id) {
                $model->id = Str::uuid()->toString();
            }
        });
    }

    public function suppliers()
    {
        return $this->hasMany(Supplier::class, 'supplier_type_id', 'id');
    }
}
