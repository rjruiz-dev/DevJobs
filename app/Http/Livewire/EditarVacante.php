<?php

namespace App\Http\Livewire;

use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;

class EditarVacante extends Component
{
    public $vacante_id; //  $id es palabra reservada de livewire

    // son los nombres segun los tenemos en wire:model del componete editar_vacante.blade.php
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen; // no es obligatorio
    public $imagen_nueva; // en caso de actualizar la imagen 

    use WithFileUploads;

    // Reglas de validacion
    // debe de tener el mismo nombre con wire:model
    protected $rules = [
        'titulo'      => 'required|string',
        'salario'     => 'required',
        'categoria'   => 'required',
        'empresa'     => 'required',
        'ultimo_dia'  => 'required',
        'descripcion' => 'required',
        'imagen_nueva'=> 'nullable|image|max:1024', // tamaño max: 1mb
    ];

    // Cuando el componente ha sido instanciado y solo se ejecuta una ves
    // mount(Vacante): es el modelo, $vacante es la instancia
    public function mount(Vacante $vacante)
    {       
        $this->vacante_id = $vacante->id;
        $this->titulo = $vacante->titulo;  //  $this->titulo hace referncia a public $titulo
        $this->salario = $vacante->salario_id; // salario_id: es el campo de la db
        $this->categoria = $vacante->categoria_id; 
        $this->empresa = $vacante->empresa; 
        $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format('Y-m-d'); // Formato a fecha 
        $this->descripcion = $vacante->descripcion; 
        $this->imagen = $vacante->imagen; 
    }

    public function editarVacante()
    {
        $datos = $this->validate();

        // si hay una nueva imagen
        if($this->imagen_nueva){
            $imagen = $this->imagen_nueva->store('public/vacantes');
            $datos['imagen'] = str_replace('public/vacantes', '', $imagen);
        }

        // encontrar la vacante a editar
        $vacante = Vacante::find($this->vacante_id);

        // asignar los valores
        $vacante->titulo = $datos['titulo'];
        $vacante->salario_id = $datos['salario'];
        $vacante->categoria_id = $datos['categoria'];
        $vacante->empresa = $datos['empresa'];
        $vacante->ultimo_dia = $datos['ultimo_dia'];
        $vacante->descripcion = $datos['descripcion'];
        $vacante->imagen = $datos['imagen'] ?? $vacante->imagen;

        // guardar la vacante 
        $vacante->save();

        // redireccionar
        session()->flash('mensaje', 'La Vacante se actualizó Correctamente');

        return redirect()->route('vacantes.index');
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
