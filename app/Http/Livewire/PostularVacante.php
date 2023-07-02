<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    use WithFileUploads; // habilita la carga de archivos.   
    
    public $cv; // public $cv; conectamos con postular-vacante.blade.php mediante wire:model="cv" 

    // validacion
    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];

    // llamamos a la funcion declarada en el formulario en postular-vacante.blade.php
    public function postularme() 
    {
        
        $datos = $this->validate();

        // Almacenar el cv y la referencia del cv
        $cv = $this->cv->store('public/cv');// store() metodo de livewire
        $datos['cv'] = str_replace('public/cv/','', $cv);
        
        // Crear la vacante

        // Crear notificacion y enviar el email

        // Mosrtar el usuario un mensaje de ok
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
