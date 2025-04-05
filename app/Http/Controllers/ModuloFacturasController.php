<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ModuloFacturasController extends Controller
{
    /**
     * Muestra todas las facturas.
     */
    public function informacion()
    {
        $response = Http::get('http://localhost:3000/ModuloFactura/GetFacturas', [
            'valor' => 0
        ]);

        if ($response->successful()) {
            //Este es un array que contiene la información de las facturas
            $Facturas = $response->json();
        } else {
            $Facturas = [];  // Si hay error, devuelve array vacío
        }
    
        // Verifica qué datos está recibiendo Laravel
         //Aqui se va a compactar el array de facturas
        //return view('ModuloFactura.informacion', compact('Facturas'));
        return view('vistaFacturas', compact('Facturas'));
        
        
    }

    /**
     * Inserta una nueva factura.
     */
    public function insertar(Request $request)
    {
        // Calcular impuesto y total
        $subtotal = $request->subtotal;
        $descuento = $request->descuento;
        $subtotalConDescuento = $subtotal - $descuento;
        $impuesto = $subtotalConDescuento * 0.15; // 15% de IVA
        $total = $subtotalConDescuento + $impuesto;

        $response = Http::post('http://localhost:3000/ModuloFactura/CrearFactura', [
            'cod_persona' => $request->cod_persona,
            'cod_boleto' => $request->cod_boleto,
            'fecha_facturacion' => $request->fecha_facturacion,
            'metodo_pago' => $request->metodo_pago,
            'descuento' => $request->descuento,
            'subtotal' => $request->subtotal,
            'total' => round($total, 2),
            'impuesto' => round($impuesto, 2),
        ]);

        return $response->successful()
            ? redirect()->route('Facturas')->with('success', 'Factura insertada correctamente')
            : redirect()->route('Facturas')->with('error', 'Hubo un error al insertar la factura');
    }

    /**
     * Edita una factura (opcional, normalmente no se usa aquí).
     */
    public function edit(string $id)
    {
        $response = Http::get("http://localhost:3000/ModuloFactura/GetFacturas");
        $Facturas = $response->successful() ? $response->json() : [];

        $Factura = collect($Facturas)->firstWhere('COD_FACTURA', $id);

        return view('vistaFacturas', compact('Facturas'));
    }

    /**
     * Actualiza una factura.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        'cod_persona' => 'required|numeric',
        'cod_boleto' => 'required|numeric',
        'fecha_facturacion' => 'required|date',
        'metodo_pago' => 'required|string',
        'descuento' => 'required|numeric|min:0',
        'subtotal' => 'required|numeric|min:0',
    ]);

    $subtotalConDescuento = $request->subtotal - $request->descuento;
    $impuesto = $subtotalConDescuento * 0.15;
    $total = $subtotalConDescuento + $impuesto;

    $response = Http::put("http://localhost:3000/ModuloFactura/ActualizarFactura/", [
        'cod_factura' => $id,
        'cod_persona' => $request->cod_persona,
        'cod_boleto' => $request->cod_boleto,
        'fecha_facturacion' => $request->fecha_facturacion,
        'metodo_pago' => $request->metodo_pago,
        'descuento' => $request->descuento,
        'subtotal' => $request->subtotal,
        'total' => round($total, 2),
        'impuesto' => round($impuesto, 2),
    ]);

    return $response->successful()
        ? redirect()->route('Facturas')->with('success', 'Factura actualizada correctamente')
        : redirect()->route('Facturas')->with('error', 'Error al actualizar la factura');
}

    /**
     * Elimina una factura.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("http://localhost:3000/ModuloFactura/BorrarFactura/$id");

        return $response->successful()
            ? redirect()->route('Facturas')->with('success', 'Factura eliminada correctamente')
            : redirect()->route('Facturas')->with('error', 'Error al eliminar la factura');
    }
}
