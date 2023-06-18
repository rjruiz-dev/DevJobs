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
        return view('vacantes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vacantes.create');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // con route model binding importamos el modelo Vacante (en ves de usar $id)
    public function edit(Vacante $vacante)
    {
        // policy
        $this->authorize('update', $vacante);

        // dd($vacante);
        return view('vacantes.edit', [
            'vacante' => $vacante
        ]);
    }   
}
