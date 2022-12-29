<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harian extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function Server()
    {
        return $this->belongsTo(Server::class, 'id_server');
    }

    public function Backup()
    {
        return $this->belongsTo(DataBackup::class, 'id_backup');
    }

    public function Image()
    {
        return $this->belongsTo(Image::class, 'id_harian');
    }
}
