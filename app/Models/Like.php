<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'likefoto';
    protected $fillable = ['user_id', 'foto_id'];

    /**
     * Mendefinisikan relasi antara LikeFoto dan User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Tambahkan 'user_id' sebagai kunci asing
    }

    /**
     * Mendefinisikan relasi antara LikeFoto dan Foto.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function foto()
    {
        return $this->belongsTo(Foto::class, 'foto_id'); // Tambahkan 'foto_id' sebagai kunci asing
    }

}