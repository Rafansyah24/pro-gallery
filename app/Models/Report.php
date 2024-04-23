<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['description'];
    protected $table = 'report';

    protected $attributes = [
        'description' => '', // Atur nilai default di sini
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function photo()
    {
        return $this->belongsTo(Foto::class, 'foto_id', 'id');
    }

    public function delete()
    {
        // Hapus record ReportPhoto
        parent::delete();
    }
}