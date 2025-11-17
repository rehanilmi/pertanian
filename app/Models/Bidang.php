<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Bidang extends Model
{
    protected $table = 'bidangs';
    protected $primaryKey = 'id';
    public $incrementing = false;       // UUID
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'bidang',
        'struktur_organisasi',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    // RELASI: satu bidang punya banyak pengumuman
    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class, 'bidang_id', 'id');
    }
}
