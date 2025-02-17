<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagArtikel extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'tag_artikel';

    protected $fillable = [
        'tag',
        'slug'
    ];

    public function artikel(){
        return $this->hasMany(Artikel::class, 'tag_artikel_id', 'id');
    }
}
