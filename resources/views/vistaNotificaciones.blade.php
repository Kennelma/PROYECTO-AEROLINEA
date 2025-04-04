@extends('adminlte::page')


@section('title','Notificaciones')


@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                      <!-- Título encima del botón -->
                      <h3>MÓDULO NOTIFICACIONES</h3>
                    </div>
                    <div class="card-body">
                        
                        <!--Aqui pondre el boton para que aparezca arriba de la tabla-->
                        <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Nueva notificación
                        </button>-->

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="fas fa-bell"></i> <i class="fas fa-plus"></i> 
                        </button>
                        <br> 
                        

                        <table id="Notificaciones" class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>COD_NOTIFICACION</th>
                                    <th>TIPO_NOTIFICACION</th>
                                    <th>TIPO_ALERTA</th>
                                    <th>COD_RESERVA</th>
                                    <th>PRIORIDAD</th>
                                    <th>MENSAJE</th>
                                    <th>ACCIONES</th>
                                </tr>        
                            </thead>
                            <tbody>
                                @foreach($Notificaciones as $Notificacion)
                                <tr class="text-center">
                                    <td class="text-center">{{ $Notificacion['COD_NOTIFICACION'] }}</td>
                                    <td>{{ $Notificacion['TIPO_NOTIFICACION'] }}</td>
                                    <td>{{ $Notificacion['TIPO_ALERTA'] }}</td>
                                    <td>{{ $Notificacion['COD_RESERVA'] }}</td>
                                    <td>{{ $Notificacion['PRIORIDAD'] }}</td>
                                    <td>{{ $Notificacion['MENSAJE'] }}</td>
                                    <td class="text-center">
                                        <!-- Botón para abrir el modal de edición -->
                                        <!--<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $Notificacion['COD_NOTIFICACION'] }}">
                                            Editar
                                        </button>-->
                                        <button type="button" class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $Notificacion['COD_NOTIFICACION'] }}">
                                            <i class="fas fa-bell"></i> <i class="fas fa-edit"></i>
                                        </button>


                                        <!-- Formulario para eliminar la notificación -->
                                        <form action="{{ route('Notificaciones.destroy', $Notificacion['COD_NOTIFICACION']) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <!--<button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta notificación?')">
                                                Eliminar
                                            </button>-->

                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $Notificacion['COD_NOTIFICACION'] }}">
                                                <i class="fas fa-trash"></i> 
                                            </button>

                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal de Edición -->
                                <div class="modal fade" id="editModal{{ $Notificacion['COD_NOTIFICACION'] }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Notificación</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('Notificaciones.update', $Notificacion['COD_NOTIFICACION']) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3">
                                                        <label class="form-label">Tipo Notificación</label>
                                                        <input type="text" class="form-control" name="tipo_notificacion" value="{{ $Notificacion['TIPO_NOTIFICACION'] }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Tipo Alerta</label>
                                                        <input type="text" class="form-control" name="tipo_alerta" value="{{ $Notificacion['TIPO_ALERTA'] }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Código Reserva</label>
                                                        <input type="text" class="form-control" name="cod_reserva" value="{{ $Notificacion['COD_RESERVA'] }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Prioridad</label>
                                                        <input type="text" class="form-control" name="prioridad" value="{{ $Notificacion['PRIORIDAD'] }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Mensaje</label>
                                                        <input type="text" class="form-control" name="mensaje" value="{{ $Notificacion['MENSAJE'] }}" required>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    
                                                    
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                @endforeach
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Aqui pondre el modal-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Insertar notificación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <!-- aqui agg el formularip -->
        <form   action="{{ route('Notificaciones') }}" method="POST">
            @csrf
            
            <div class="form-group">
              <label for="tipo_notificacion">TIPO NOTIFICACIÓN</label>
              <input type="text" class="form-control" id="tipo_notificacion" name="tipo_notificacion" required>
            </div>
            <div class="form-group">
              <label for="tipo_alerta">TIPO ALERTA</label>
              <input type="text" class="form-control" id="tipo_alerta" name="tipo_alerta" required>
            </div>
            <div class="form-group">
              <label for="cod_reserva">COD RESERVA</label>
              <input type="text" class="form-control" id="cod_reserva" name="cod_reserva" required>
            </div>
            <div class="form-group">
              <label for="prioridad">PRIORIDAD</label>
              <input type="text" class="form-control" id="prioridad" name="prioridad" required>
            </div>
            <div class="form-group">
              <label for="mensaje">MENSAJE</label>
              <input type="text" class="form-control" id="mensaje" name="mensaje" required>
            </div>


            
            <button type="submit" class="btn btn-warning text-dark mr-2">INSERTAR</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>

        </form>

      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
 

@stop

@section('css')

@stop

@section('js')

<!--<script type="text/javascript"> 
let table = new DataTable('#Notificaciones');
</script>-->

<script type="text/javascript"> 
let table = new DataTable('#Notificaciones', {
    language: {
        search: "Buscar",  // Cambia "Search" a "Buscar"
        lengthMenu: "Mostrar _MENU_ registros por página",  // Texto para mostrar el número de registros por página
        info: "Mostrando _START_ a _END_ de _TOTAL_ registros",  // Información de los registros
        infoEmpty: "Mostrando 0 a 0 de 0 registros",  // Información cuando no hay registros
        infoFiltered: "(filtrado de _MAX_ registros en total)",  // Información cuando los registros son filtrados
        paginate: {
            first: "Primero",  // Texto para el botón de primera página
            previous: "Anterior",  // Texto para el botón de página anterior
            next: "Siguiente",  // Texto para el botón de página siguiente
            last: "Último"  // Texto para el botón de última página
        }
    }
});
</script>



@stop