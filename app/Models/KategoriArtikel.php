<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriArtikel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori_artikel';


    protected $fillable = [
        'kategori',
        'slug'
    ];


    public function artikel(){
        return $this->hasMany(Artikel::class, 'kategori_artikel_id', 'id');
    }
}
