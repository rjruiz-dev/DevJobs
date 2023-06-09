<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pasamos el modelo Vacante::class previene el acceso a todo lo relacionado con el modelo
        $this->authorize('viewAny', Vacante::class);
        return view('vacantes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Vacante::class);
        return view('vacantes.create');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Vacante $vacante)
    {
        return view('vacantes.show', [
            'vacante' => $vacante
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // con route model binding importamos el modelo Vacante (en ves de usar $id)
    public function edit(Vacante $vacante)
    {
        // policy pasamos la instancia
        $this->authorize('update', $vacante);

        // dd($vacante);
        return view('vacantes.edit', [
            'vacante' => $vacante
        ]);
    }   
}
