<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class BeritaImage extends Model
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['berita_id', 'gambar'];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }
}
