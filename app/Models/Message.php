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
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function daerah()
    {
        return $this->belongsTo(Daerah::class);
    }
}
