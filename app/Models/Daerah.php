<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Daerah extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
