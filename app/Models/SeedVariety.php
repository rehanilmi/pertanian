<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class SeedVariety extends Model
{
    use HasFactory;

    protected $table = 'seed_varieties';
    protected $fillable = ['name', 'type', 'description'];

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

    public function stocks()
    {
        return $this->hasMany(SupplierStock::class, 'variety_id');
    }
}
