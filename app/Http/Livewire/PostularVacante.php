<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PostularVacante extends Component
{
    // public $cv; conectamos con postular-vacante.blade.php mediante wire:model="cv" 
    public $cv;

    // validacion
    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];

    // llamamos a la funcion declarada en el formulario en postular-vacante.blade.php
    public function postularme() 
    {
        $this->validate();

        // Alamacenar CV en el disco duro
        
        // Crear la vacante

        // Crear notificacion y enviar el email

        // Mosrtar el usuario un mensaje de ok
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
