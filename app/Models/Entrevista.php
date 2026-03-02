<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrevista extends Model
{
    use HasFactory;

    protected $table = 'entrevistas';

    protected $fillable = [
        'adopcion_id',
        'fecha_entrevista',
        'notas',
        'resultado',
        'administrador_id',
    ];

    protected $casts = [
        'fecha_entrevista' => 'date',
    ];

    public function adopcion()
    {
        return $this->belongsTo(Adopcion::class, 'adopcion_id');
    }

    public function administrador()
    {
        return $this->belongsTo(User::class, 'administrador_id');
    }
}
