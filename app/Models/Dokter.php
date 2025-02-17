<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dokter extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dokter';

    protected $fillable = [
        'nama_lengkap',
        'spesialis',
        'status',
        'users_id',
        'foto'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

}
