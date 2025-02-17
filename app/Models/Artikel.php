<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artikel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'artikel';
    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'gambar_',
        'kategeri_artikel_id',
        'tag_artikel_id',
        'user_id',
    ];

    public function kategori_artikel()
    {
        return $this->belongsTo(KategoriArtikel::class, 'kategori_artikel_id', 'id');
    }

    public function tag_artikel()
    {
        return $this->belongsTo(TagArtikel::class, 'tag_artikel_id', 'id');
    }
}
