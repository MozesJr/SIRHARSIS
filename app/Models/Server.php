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

    public function DNS()
    {
        return $this->belongsTo(IpAddress::class, 'id_ipAddress');
    }

    public function ENDB()
    {
        return $this->belongsTo(EngineDB::class, 'id_enDB');
    }

    public function ENAPP()
    {
        return $this->belongsTo(Engine::class, 'id_enApp');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'id_pic_idUsers');
    }

    public function BHS()
    {
        return $this->belongsTo(BhsPrg::class, 'id_bhsApp');
    }

    public function Path()
    {
        return $this->belongsTo(Path::class, 'id_pathAkses');
    }

    public function PathApp()
    {
        return $this->belongsTo(PathApp::class, 'id_pathApp');
    }

    public function PathDB()
    {
        return $this->belongsTo(PathDB::class, 'id_pathDB');
    }

    public function TGL()
    {
        return $this->belongsTo(TglGo::class, 'id_tglGo');
    }
}
