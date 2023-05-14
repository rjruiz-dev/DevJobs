<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MostrarAlerta extends Component
{
    // sabe y espera una variable $message
    public $message;

    public function render()
    {
        return view('livewire.mostrar-alerta');
    }
}
