<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    public $incrementing = false; // non-auto increment
    protected $keyType = 'string'; // tipe key string (bukan integer)

    protected $fillable = [
        'judul', 'slug', 'isi', 'gambar'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
