<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpAddress extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function Server()
    {
        return $this->belongsTo(Server::class, 'id_ipAddress');
    }
}
