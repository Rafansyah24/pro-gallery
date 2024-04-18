<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = ['nama_album', 'desc', 'photo', 'user_id'];

    protected $table = 'albums';


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Foto()
    {
        return $this->hasMany(Foto::class);
    }
}