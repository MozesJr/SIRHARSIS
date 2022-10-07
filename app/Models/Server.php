<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function Status()
    {
        return $this->belongsTo(Status::class, 'id_statuses');
    }

    public function Level()
    {
        return $this->belongsTo(Level::class, 'id_levels');
    }
}
