<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageGallery extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function harian()
    {
        return $this->belongsTo(Harian::class, 'id');
    }
}
