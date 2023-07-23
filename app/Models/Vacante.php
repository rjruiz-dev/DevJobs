<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    use HasFactory;

    protected $casts = ['ultimo_dia'=>'date']; // en lugar de string, va a ser una fecha (sin esto blade lo trata como string)

    protected $fillable = [
        'titulo',
        'salario_id',
        'categoria_id',
        'empresa',
        'ultimo_dia',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function salario()
    {
        return $this->belongsTo(Salario::class);
    }

    public function candidatos()
    {
        // Una vacante tiene muchos candidatos
        return $this->hasMany(Candidato::class)->orderBy('created_at', 'DESC'); 
    }

    // la relacion es hacia el reclutador la persona que publico la vacante
    public function reclutador()
    {
        // una vacante pertenence a un usuario
        return $this->belongsTo(User::class, 'user_id'); // 'user_id': los usuarios se almacenan en la tabla de users
    }
}
