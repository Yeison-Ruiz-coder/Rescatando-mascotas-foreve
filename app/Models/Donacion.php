<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donacion extends Model
{
    use HasFactory;

    protected $table = 'donaciones';

    protected $fillable = [
        'valor_donacion',
        'fecha_donacion',
        'publica',
        'user_id',
        'fundacion_id',
    ];

    protected $casts = [
        'fecha_donacion' => 'datetime',
        'publica' => 'boolean',
        'valor_donacion' => 'decimal:2',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fundacion()
    {
        return $this->belongsTo(Fundacion::class, 'fundacion_id');
    }
}
