<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoEdukasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'video_edukasi';

    protected $fillable = [
        'url', 'status', 'create_by', 'update_by'
    ];
}
