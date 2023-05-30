<?php

namespace App\Http\Livewire;

use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Illuminate\Support\Carbon;

class EditarVacante extends Component
{
    // son los nombres segun los tenemos en wire:model del componete editar_vacante.blade.php
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;


    // Cuando el componente ha sido instanciado y solo se ejecuta una ves
    // mount(Vacante): es el modelo, $vacante es la instancia
    public function mount(Vacante $vacante)
    {       
        $this->titulo = $vacante->titulo;  //  $this->titulo hace referncia a public $titulo
        $this->salario = $vacante->salario_id; // salario_id: es el campo de la db
        $this->categoria = $vacante->categoria_id; 
        $this->empresa = $vacante->empresa; 
        $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format('Y-m-d'); // Formato a fecha 
        $this->descripcion = $vacante->descripcion; 
        $this->imagen = $vacante->imagen; 
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
