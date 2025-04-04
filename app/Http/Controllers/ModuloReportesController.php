<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ModuloReportesController extends Controller
{

        //----PARA SELECCIONAR DATOS DE LAS TABLAS
        public function informacion($tabla)
        {

            $url = "http://localhost:3000/ModuloReportes/Obtener_Reportes/{$tabla}";

           // Iniciar un array vacío para los datos
           $data = [];

           $response = Http::get($url);
               
           if ($response->successful()) {
               //Se si cargan los datos los manda a la vista
               $data = $response->json();
           } else {
               //Si vuelve a pasar problemas con la api, esto muestra una alerta
               $data = [];
           }
    
            $vistas = [
                'reportes' => 'vistasModuloReportes.vistaReportes',
                'graficos' => 'vistasModuloReportes.vistaGraficos',
            ];

            // Retornar la vista con los datos obtenidos
            return view($vistas[$tabla] ?? 'vistasModuloReportes.vistaReportes', ['data' => $data]);
        }

     
      //----PARA ELIMINAR DATOS DE LAS TABLAS
      public function eliminar(Request $request)
        {
          //Obtener la tabla y el ID del request
          $tabla = $request->input('tabla');
          $id = $request->input('id');
  
          $url = "http://localhost:3000/ModuloReportes/Eliminar_Reporte";
  
          $response = Http::delete($url, ['tabla' => $tabla,'id' => $id,]);
  
          return back(); //me devuelve a la vista en la que estaba
        }
  
  
      //----PARA INSERTAR DATOS A LA TABLA---
      public function insertar(Request $request) {
        $tabla = $request->input('tabla');
        $valores = $request->input('valores');
        
        $url = "http://localhost:3000/ModuloReportes/Insertar_Reportes";
  
        $response = Http::post($url, ['tabla' => $tabla,'valores' => $valores,]);
  
        if ($response->successful()) {
            return back()->with('success', 'Registro agregado correctamente.');
        } else {
            return back()->with('error', 'Hubo un problema al agregar el registro.');
        }    
      }
  
  
}
