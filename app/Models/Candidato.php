<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'vacante_id', 
        'cv' 
    ];

    public function user(){
        // Esta relacion hacia usuario pertenece a el modelo de usuario
        return $this->belongsTo(User::class);

    }
}
