<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'message_id',
        'kategori_id',
        'wish',
    ];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

}
