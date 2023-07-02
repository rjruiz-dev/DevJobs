<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    use WithFileUploads; // habilita la carga de archivos.   
    
    public $cv; // public $cv; conectamos con postular-vacante.blade.php mediante wire:model="cv" 
    public $vacante;

    // validacion
    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];

    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    // llamamos a la funcion declarada en el formulario en postular-vacante.blade.php
    public function postularme() 
    {
        
        $datos = $this->validate();

        // Almacenar el cv y la referencia del cv
        $cv = $this->cv->store('public/cv');// store() metodo de livewire
        $datos['cv'] = str_replace('public/cv/','', $cv);
        
        // Crear el candidato a la vacante
        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id,
            'cv' => $datos['cv']
            // mediante la relacion candidatos() internamente ya sabe cual va a ser el id de vacante_id
        ]);

        // Crear notificacion y enviar el email

        // Mosrtar el usuario un mensaje de ok
        session()->flash('mensaje', 'Se envió correctamente tu informacion, mucha suerte!!');


        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
