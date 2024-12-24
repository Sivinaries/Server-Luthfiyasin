<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'pekerjaan',
        'whatsapp',
        'email',
        'usia',
        'daerah_id',
    ];

    public function kategoriMessages()
    {
        return $this->hasMany(KategoriMessage::class);
    }

    public function daerah()
    {
        return $this->belongsTo(Daerah::class);
    }
}
