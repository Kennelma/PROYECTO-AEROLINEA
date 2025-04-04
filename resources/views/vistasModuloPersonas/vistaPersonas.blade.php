@extends('adminlte::page')

@section('title', 'Personas')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Personas</h4>
                        <button type="button" class="btn ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: #28a745; color: white;">
                            <i class="fas fa-plus"></i> Agregar registro nuevo
                        </button>

                        <!-- Se importa el modal de esta tabla -->
                        @include('vistasModuloPersonas.modal-Personas') 
                    </div>

                    <div class="card-body">

                        <!-- Tabla de personas -->
                        <table id="personas" class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>COD PERSONA</th>
                                    <th>NOMBRE</th>
                                    <th>APELLIDO</th>
                                    <th>EDAD</th>
                                    <th>DNI</th>
                                    <th>ESTADO CIVIL</th>
                                    <th>NACIONALIDAD</th>
                                    <th>GÉNERO</th>
                                    <th>ACCIONES</th>
                                </tr>        
                            </thead>

                            <tbody>
                                @foreach($data as $persona) <!-- Cambié $personas por $data -->
                                    <tr class="text-center">
                                        <td>{{ $persona['COD_PERSONA'] }}</td>
                                        <td>{{ $persona['NOMBRE'] }}</td>
                                        <td>{{ $persona['APELLIDO'] }}</td>
                                        <td>{{ $persona['EDAD'] }}</td>
                                        <td>{{ $persona['DNI'] }}</td>
                                        <td>{{ $persona['ESTADO_CIVIL'] }}</td>
                                        <td>{{ $persona['NACIONALIDAD'] }}</td>
                                        <td>{{ $persona['GENERO'] }}</td>
                                        <td>
                                        <button type="button" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>

                                            <!-- Formulario para eliminar -->
                                            <form action="{{ route('ModuloPersonas.Eliminar') }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="tabla" value="Personas">
                                                <input type="hidden" name="id" value="{{ $persona['COD_PERSONA'] }}">
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