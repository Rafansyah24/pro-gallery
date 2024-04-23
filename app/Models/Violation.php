<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    use HasFactory;

    protected $fillable = ['foto_id', 'description'];

    public function photo()
    {
        return $this->belongsToMany(foto::class);
    }
}