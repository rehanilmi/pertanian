<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class SupplierStock extends Model
{
    use HasFactory;

    protected $table = 'supplier_stocks';
    protected $fillable = [
        'supplier_id',
        'variety_id',
        'quantity',
        'unit',
        'price',
        'stock_date'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function booted()
    {
        static::creating(function($model){
            if (!$model->id) {
                $model->id = Str::uuid()->toString();
            }
        });
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function variety()
    {
        return $this->belongsTo(SeedVariety::class, 'variety_id');
    }

    public function logs()
    {
        return $this->hasMany(SupplierStockLog::class, 'supplier_stock_id');
    }

}
