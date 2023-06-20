<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class MostrarVacantes extends Component
{
    // colocar la funciones que van a escuchar por algun evento, que se emita en la vista o template
    protected $listeners = ['eliminarVacante'];
    
    // route model binding  (Vacante $vacante) es un objeto completo con toda la informacion de la vacante
    public function eliminarVacante(Vacante $vacante)
    {
        // dd($vacante->titulo);
        $vacante->delete();
    }

    public function render()
    {
        $vacantes = Vacante::where('user_id', auth()->user()->id)->paginate(10);

        return view('livewire.mostrar-vacantes', [
            'vacantes' => $vacantes
        ]);
    }
}
