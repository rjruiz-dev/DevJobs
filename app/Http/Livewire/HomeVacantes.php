<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class HomeVacantes extends Component
{
    public $termino;
    public $categoria;
    public $salario;

    protected $listeners = ['terminoBusqueda' => 'buscar']; // escucha por terminoBusqueda y cuando ese evento ocurra manda a llamar buscar()
    
    public function buscar($termino, $categoria, $salario)
    {
        // dd('Desde componente padre');
        $this->termino   = $termino;
        $this->categoria = $categoria;
        $this->salario   = $salario;

    }
    
    public function render()
    {
        // $vacantes = Vacante::all();

        // when se ejecuta si hay un termino, entonces se ejecuta el callback $query busca en el titulño ese termino
        $vacantes = Vacante::when($this->termino, function($query){
            $query->where('titulo', 'LIKE', "%" . $this->termino . "%");
        })->paginate(20);

        return view('livewire.home-vacantes', [
            'vacantes' => $vacantes
        ]);
    }
}
