<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'komentar';
    protected $fillable = ['user_id', 'foto_id','isi_komentar'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Tambahkan 'user_id' sebagai kunci asing
    }

    public function foto()
    {
        return $this->belongsTo(Foto::class, 'foto_id'); // Tambahkan 'foto_id' sebagai kunci asing
    }
}