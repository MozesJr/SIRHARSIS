<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetServer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function DB()
    {
        return $this->belongsTo(Ext::class, 'id_ext');
    }

    public function Server()
    {
        return $this->belongsTo(Server::class, 'id_servers');
    }
}
