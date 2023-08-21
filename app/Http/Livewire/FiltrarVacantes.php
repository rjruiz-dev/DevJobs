<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use Livewire\Component;

class FiltrarVacantes extends Component
{
    public $termino;
    public $categoria;
    public $salario;

    public function leerDatosFormulario()
    {
        // dd('Buscando...');
        $this->emit('terminoBusqueda', $this->termino, $this->categoria, $this->salario); // emite el evento terminoBusqueda
    }

    public function render()
    {
        $salarios   = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.filtrar-vacantes',[
            'salarios'   => $salarios,
            'categorias' => $categorias
        ]);
    }
}
