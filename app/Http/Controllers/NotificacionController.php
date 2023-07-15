<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    // Es un controlador con un solo metodo 
    public function __invoke(Request $request)
    {
        // dd('Desde Notificacion Controller');
        // las notificaciones que el usuario aun no ha leido
        $notificaciones = auth()->user()->unreadNotifications;
        return view ('notificaciones.index', [
            'notificaciones' => $notificaciones
        ]);
    }
}
