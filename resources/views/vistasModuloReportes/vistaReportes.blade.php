@extends('adminlte::page')

@section('title', 'Reportes')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Reportes</h4>
                        <button type="button" class="btn ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: #28a745; color: white;">
                            <i class="fas fa-plus"></i> Agregar registro nuevo
                        </button>

                        <!-- Se importa el modal de esta tabla -->
                         
                    </div>

                    <div class="card-body">

                        <!-- Tabla de REPORTES -->
                        <table id="reportes" class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>COD REPORTE</th>
                                    <th>COD EMPLEADO</th>
                                    <th>ASUNTO</th>
                                    <th>TIPO REPORTE</th>
                                    <th>FECHA GENERACION</th>
                                    <th>ESTADO REPORTE</th>
                                    <th>ACCIONES</th>
                                </tr>        
                            </thead>

                            <tbody>
                                @foreach($data as $reporte) <!-- Cambié $reporte por $data -->
                                    <tr class="text-center">
                                        <td>{{ $reporte['COD_REPORTE'] }}</td>
                                        <td>{{ $reporte['COD_EMPLEADO'] }}</td>
                                        <td>{{ $reporte['ASUNTO'] }}</td>
                                        <td>{{ $reporte['TIPO_REPORTE'] }}</td>
                                        <td>{{ $reporte['FECHA_GENERACION'] }}</td>
                                        <td>{{ $reporte['ESTADO_REPORTE'] }}</td>
                                        <td>
                                        <button type="button" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>

                                            <!-- Formulario para eliminar -->
                                            <form action="{{ route('ModuloReportes.Eliminar') }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="tabla" value="Reportes">
                                                <input type="hidden" name="id" value="{{ $reporte['COD_REPORTE'] }}">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este registro?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        
                                        </td>
                                    
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
