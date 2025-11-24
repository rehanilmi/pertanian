<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SupplierStockLog extends Model
{
    protected $fillable = [
        'supplier_stock_id',
        'change_type',
        'quantity',
        'note',
        'created_by'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->id) $model->id = Str::uuid();
            if (auth()->check()) $model->created_by = auth()->id();
        });
    }

    public function stock()
    {
        return $this->belongsTo(SupplierStock::class, 'supplier_stock_id');
    }
}
