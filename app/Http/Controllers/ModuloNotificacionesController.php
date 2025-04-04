<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ModuloNotificacionesController extends Controller{

     /**
     * Display a listing of the resource.
     */
    public function informacion()
    {
        
        $response = Http::get('http://localhost:3000/ModuloNotificaciones/GetNotificaciones', [
            'valor' => 0
        ]);

        if ($response->successful()) {
            //Este es un array que contiene la información de las notificaciones
            $Notificaciones = $response->json();
        } else {
            $Notificaciones = [];  // Si hay error, devuelve array vacío
        }
    
        // Verifica qué datos está recibiendo Laravel
         //Aqui se va a compactar el array de notificaciones
        //return view('ModuloNotificaciones.informacion', compact('Notificaciones'));
        return view('vistaNotificaciones', compact('Notificaciones'));
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function insertar(Request $request)
    {
        
    $response = Http::post('http://localhost:3000/ModuloNotificaciones/CrearNotificacion/', [
        'tipo_notificacion' => $request->tipo_notificacion,
        'tipo_alerta' => $request->tipo_alerta,
        'cod_reserva' => $request->cod_reserva,
        'prioridad' => $request->prioridad,
        'mensaje' => $request->mensaje,
    ]);
    
    if ($response->successful()) {
        return redirect()->route('Notificaciones')->with('success', 'Notificación insertada correctamente');
    } else {
        return redirect()->route('Notificaciones')->with('error', 'Hubo un error al insertar la notificación');
    }

    }


    public function edit(string $id)
    {
        // Obtener la notificación específica que se quiere editar
        $response = Http::get("http://localhost:3000/ModuloNotificaciones/GetNotificaciones");
        $Notificaciones = $response->successful() ? $response->json() : [];
    
        $Notificacion = collect($Notificaciones)->firstWhere('COD_NOTIFICACION', $id);
    
        return view('vistaNotificaciones', compact('Notificaciones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tipo_notificacion' => 'required|string|max:255',
            'tipo_alerta' => 'required|string|max:255',
            'cod_reserva' => 'required|string|max:255',
            'prioridad' => 'required|string|max:255',
            'mensaje' => 'required|string|max:500',
        ]);
    
        // Realiza la solicitud PUT al backend de la API para actualizar la notificación
        $response = Http::put("http://localhost:3000/ModuloNotificaciones/ActualizarNotificacion", [
            'cod_notificacion' => $id,
            'cod_reserva' => $request->cod_reserva,
            'tipo_notificacion' => $request->tipo_notificacion,
            'tipo_alerta' => $request->tipo_alerta,
            'prioridad' => $request->prioridad,
            'mensaje' => $request->mensaje,
        ]);
    
        return $response->successful()
            ? redirect()->route('Notificaciones')->with('success', 'Notificación actualizada correctamente')
            : redirect()->route('Notificaciones')->with('error', 'No se pudo actualizar la notificación');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Realiza la solicitud DELETE al backend de la API para eliminar la notificación
    $response = Http::delete("http://localhost:3000/ModuloNotificaciones/BorrarNotificacion/$id");

    // Verifica si la respuesta fue exitosa
    return $response->successful()
        ? redirect()->route('Notificaciones')->with('success', 'Notificación eliminada correctamente')
        : redirect()->route('Notificaciones')->with('error', 'Error al eliminar la notificación');
    }

    

}
