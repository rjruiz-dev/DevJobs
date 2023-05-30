<?php

namespace App\Http\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Vacante;

class EditarVacante extends Component
{
    public $titulo;


    // Cuando el componente ha sido instanciado y solo se ejecuta una ves
    // mount(Vacante): es el modelo, $vacante es la instancia
    public function mount(Vacante $vacante)
    {
        //  $this->titulo hace referncia a public $titulo
        $this->titulo = $vacante->titulo;
    }

    public function render()
    {
        // Consultar BD
        $salarios = Salario::all();
        $categorias = Categoria::all();
        
        return view('livewire.editar-vacante', [
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}
