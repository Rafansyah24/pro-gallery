<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $fillable = ['judul_foto', 'desc', 'foto', 'user_id','album_id'];

    protected $table = 'fotos';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class); // Relasi one-to-many dengan model Komentar
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }


    public function likedByUser()
    {
        $user = auth()->user();
        return $user ? $this->likes()->where('user_id', $user->id)->exists():false;
    }

}