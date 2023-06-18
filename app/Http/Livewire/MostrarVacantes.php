<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class MostrarVacantes extends Component
{
    // colocar la funciones que van a escuchar por algun evento, que se emita en la vista o template
    // protected $listeners = ['prueba'];
    
    // public function prueba($vacante_id)
    // {
    //     // dd(vacante_id);
    // }

    public function render()
    {
        $vacantes = Vacante::where('user_id', auth()->user()->id)->paginate(10);

        return view('livewire.mostrar-vacantes', [
            'vacantes' => $vacantes
        ]);
    }
}
