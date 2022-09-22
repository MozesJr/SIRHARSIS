<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
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

    public function User()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['tanggal_awal'])
            ->format('d, M Y H:i');
    }

    public function getUpdatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['tanggal_akhir'])
            ->diffForHumans();
    }
}
