<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class ModuloPersonasController extends Controller
{

    //VARIABLE GLOBAL QUE GUARDA EL LOCALHOST3000 
    protected $baseUrl = "http://localhost:3000";
    
    //----PARA SELECCIONAR DATOS DE LAS TABLAS
    public function informacion($tabla)
    {
        //URL de la API para obtener los datos de la tabla seleccionada
        $url = "{$this->baseUrl}/ModuloPersonas/Informacion_Personas/{$tabla}";

        $data = [];

        //Hacer la consulta a la API
        $response = Http::get($url);

        //Si la respuesta es exitosa, almacenar los datos
        if ($response->successful()) {
            $data = $response->json();
        }

        $vistas = [
            'personas' => 'vistasModuloPersonas.vistaPersonas',
            'correos' => 'vistasModuloPersonas.vistaCorreos',
            'telefonos' => 'vistasModuloPersonas.vistaTelefonos',
        ];
    
        return view($vistas[$tabla], ['data' => $data]);

    }


    //----PARA ELIMINAR DATOS DE LAS TABLAS
    public function eliminar(Request $request)
    {
        //Obtener la tabla y el ID del request
        $tabla = $request->input('tabla');
        $id = $request->input('id');

        $url = "{$this->baseUrl}/ModuloPersonas/Eliminar_Persona";

        $response = Http::delete($url, ['tabla' => $tabla,'id' => $id,]);

        return back(); //me devuelve a la vista en la que estaba

    }


    //----PARA INSERTAR DATOS A LA TABLA---
    public function insertar(Request $request)
    {
        $tabla = $request->input('tabla');
        $valores = $request->input('valores');

        //Convierte los datos a string
        $valoresString = "('" . implode("', '", $valores) . "')";  

        $url = "{$this->baseUrl}/ModuloPersonas/Insertar_Persona";

        //Se hace  externa en tipo array y se guarda en la variable
        $response = Http::post($url, ['tabla' => $tabla,'valores' => $valoresString,]);

        if ($response->successful()) {
           
            return back()->with('success', 'Registro agregado correctamente.');
        } else {
            
            return back()->with('error', 'Hubo un problema al agregar el registro.');
        }

    }


}

