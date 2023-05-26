<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearVacante extends Component
{
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    // Habilitar la subida de imagen con livewire
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
        'imagen'      => 'required|max:1024', // tamaño max: 1mb
    ];

    // definir la funcion declarada en el archivo blade con wire:submit.prevent='crearVacante'
    public function crearVacante()
    {
        // validate() aplica $rules definidas 
        // si todo esta bien el formulario se asigna a una variable $datos
        $datos = $this->validate();

        // almacenar la imagen y la referencia de la imagen
        $imagen = $this->imagen->store('public/vacantes');// store() metodo de livewire
        $datos['imagen'] = str_replace('public/vacantes/','', $imagen);
        // dd($nombre_imagen);

        // crear la vacante (importar modelo Vacante)
        // desde aqui no tenemos acceso al request pero si a la variable $datos(acceso al request ya validado)
        Vacante::create([
            'titulo'      => $datos['titulo'],
            'salario_id'  => $datos['salario'],
            'categoria_id'=> $datos['categoria'],
            'empresa'     => $datos['empresa'],
            'ultimo_dia'  => $datos['ultimo_dia'],
            'descripcion' => $datos['descripcion'],
            'imagen'      => $datos['imagen'],
            'user_id'     => auth()->user()->id //obtener el usuario autenticado
        ]);

        // crear mensaje
        session()->flash('mensaje', 'La vacante se publicó correctamente');

        // redireccionar al usuario
        return redirect()->route('vacantes.index');

    }

    public function render()
    {
        // Consultar BD
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.crear-vacante', [
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}
