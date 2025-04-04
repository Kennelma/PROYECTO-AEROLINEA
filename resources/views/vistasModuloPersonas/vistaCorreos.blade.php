@extends('adminlte::page')

@section('title', 'Personas')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card  mt-4">
                    <div class="card-header">
                        <h4 class="text-center">Correos</h4>
                    </div>

                    <div class="card-body">
                        
                        <!-- Tabla de personas -->
                        <table id="correos" class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>Codigo Correo</th>
                                    <th>Dirección de Correo</th>
                                    <th>Codigo Persona</th>
                                    <th>Tipo de Correo</th>
                                </tr>        
                            </thead>

                            <tbody>
                                @foreach($data as $correo) <!-- Cambié $personas por $data -->
                                    <tr class="text-center">
                                        <td>{{ $correo['COD_CORREO'] }}</td> <!-- Usando $correo en lugar de $persona -->
                                        <td>{{ $correo['DIRECCION_CORREO'] }}</td>
                                        <td>{{ $correo['COD_PERSONA'] }}</td>
                                        <td>{{ $correo['TIPO_CORREO'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop

@section('css')

@stop

@section('js')

@stop
