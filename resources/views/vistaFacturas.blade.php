@extends('adminlte::page')

@section('title','Facturas')

@section('content')

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3>MÓDULO FACTURAS</h3>
          </div>
          <div class="card-body">

            @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            <!-- Botón Insertar -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              <i class="fas fa-file-invoice-dollar"></i> <i class="fas fa-plus"></i> 
            </button>
            <br><br>

            <!-- Tabla -->
            <table id="Facturas" class="table table-bordered table-hover">
              <thead>
                <tr class="text-center">
                  <th>COD_FACTURA</th>
                  <th>COD_PERSONA</th>
                  <th>COD_BOLETO</th>
                  <th>FECHA_FACTURACION</th>
                  <th>METODO_PAGO</th>
                  <th>DESCUENTO (%)</th>
                  <th>SUBTOTAL</th>
                  <th>TOTAL</th>
                  <th>IMPUESTO</th>
                  <th>ACCIONES</th>
                </tr>
              </thead>
              <tbody>
                @foreach($Facturas as $Factura)
                <tr class="text-center">
                  <td>{{ $Factura['COD_FACTURA'] }}</td>
                  <td>{{ $Factura['COD_PERSONA'] }}</td>
                  <td>{{ $Factura['COD_BOLETO'] }}</td>
                  <td>{{ date_format(date_create($Factura['FECHA_FACTURACION']), "d-m-Y")}}</td>
                  <td>{{ $Factura['METODO_PAGO'] }}</td>
                  <td>{{ $Factura['DESCUENTO'] }}</td>
                  <td>{{ $Factura['SUBTOTAL'] }}</td>
                  <td>{{ $Factura['TOTAL'] }}</td>
                  <td>{{ $Factura['IMPUESTO'] }}</td>
                  <td>
                    <button type="button" class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $Factura['COD_FACTURA'] }}">
                      <i class="fas fa-file-invoice-dollar"></i> <i class="fas fa-edit"></i>
                    </button>

                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $Factura['COD_FACTURA'] }}">
                      <i class="fas fa-trash"></i> 
                    </button>
                  </td>
                </tr>

                <!-- Modal Editar -->
                <div class="modal fade" id="editModal{{ $Factura['COD_FACTURA'] }}" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form action="{{ route('Facturas.update', $Factura['COD_FACTURA']) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="modal-header">
                          <h5 class="modal-title">Editar Factura</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="mb-3">
                            <label class="form-label">Código Persona</label>
                            <input type="text" class="form-control" name="cod_persona" value="{{ $Factura['COD_PERSONA'] }}" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Código Boleto</label>
                            <input type="text" class="form-control" name="cod_boleto" value="{{ $Factura['COD_BOLETO'] }}" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Fecha de Facturación</label>
                            <input type="datetime-local" class="form-control" name="fecha_facturacion"
                                   value="{{ \Carbon\Carbon::parse($Factura['FECHA_FACTURACION'])->format('Y-m-d\TH:i') }}" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Método de Pago</label>
                            <input type="text" class="form-control" name="metodo_pago" value="{{ $Factura['METODO_PAGO'] }}" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Descuento (%)</label>
                            <input type="number" class="form-control" name="descuento" id="descuento_{{ $Factura['COD_FACTURA'] }}"
                                   value="{{ $Factura['DESCUENTO'] }}" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Subtotal</label>
                            <input type="number" class="form-control" name="subtotal" id="subtotal_{{ $Factura['COD_FACTURA'] }}"
                                   value="{{ $Factura['SUBTOTAL'] }}" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Total</label>
                            <input type="number" class="form-control" name="total" id="total_{{ $Factura['COD_FACTURA'] }}"
                                   value="{{ $Factura['TOTAL'] }}" readonly required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Impuesto</label>
                            <input type="number" class="form-control" name="impuesto" id="impuesto_{{ $Factura['COD_FACTURA'] }}"
                                   value="{{ $Factura['IMPUESTO'] }}" readonly required>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Actualizar</button>
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <!-- Modal Eliminar -->
                <div class="modal fade" id="deleteModal{{ $Factura['COD_FACTURA'] }}" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form action="{{ route('Facturas.destroy', $Factura['COD_FACTURA']) }}" method="POST">
                        @csrf @method('DELETE')
                        <div class="modal-header">
                          <h5 class="modal-title">Eliminar Factura</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p>¿Estás seguro de que deseas eliminar la factura <strong>#{{ $Factura['COD_FACTURA'] }}</strong>?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-danger">Eliminar</button>
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                      </form>
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

<!-- Modal Insertar -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('Facturas') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Insertar Factura</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="cod_persona">Código Persona</label>
            <input type="number" class="form-control" id="cod_persona" name="cod_persona" required>
          </div>
          <div class="form-group">
            <label for="cod_boleto">Código Boleto</label>
            <input type="number" class="form-control" id="cod_boleto" name="cod_boleto" required>
          </div>
          <div class="form-group">
            <label for="insert_subtotal">Subtotal</label>
            <input type="number" class="form-control" id="insert_subtotal" name="subtotal" required>
          </div>
          <div class="form-group">
            <label for="insert_descuento">Descuento (%)</label>
            <input type="number" class="form-control" id="insert_descuento" name="descuento" required>
          </div>
          <div class="form-group">
            <label for="metodo_pago">Método de Pago</label>
            <input type="text" class="form-control" id="metodo_pago" name="metodo_pago" required>
          </div>
          <div class="form-group">
            <label for="insert_total">Total</label>
            <input type="number" class="form-control" id="insert_total" name="total" readonly>
          </div>
          <div class="form-group">
            <label for="insert_impuesto">Impuesto</label>
            <input type="number" class="form-control" id="insert_impuesto" name="impuesto" readonly>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning text-dark mr-2">INSERTAR</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
        </div>
      </form>
    </div>
  </div>
</div>
@stop

@section('js')
<script>
let table = new DataTable('#Facturas', {
  language: {
    search: "Buscar",
    lengthMenu: "Mostrar _MENU_ registros por página",
    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
    infoEmpty: "Mostrando 0 a 0 de 0 registros",
    infoFiltered: "(filtrado de _MAX_ registros en total)",
    paginate: {
      first: "Primero", previous: "Anterior", next: "Siguiente", last: "Último"
    }
  }
});

// Recalculo automático por porcentaje en edición
@foreach($Facturas as $Factura)
document.addEventListener('DOMContentLoaded', function () {
  const d = document.getElementById('descuento_{{ $Factura['COD_FACTURA'] }}');
  const s = document.getElementById('subtotal_{{ $Factura['COD_FACTURA'] }}');
  const t = document.getElementById('total_{{ $Factura['COD_FACTURA'] }}');
  const i = document.getElementById('impuesto_{{ $Factura['COD_FACTURA'] }}');

  function calcular() {
    const subtotal = parseFloat(s.value) || 0;
    const descuentoPct = parseFloat(d.value) || 0;
    const descuentoMoneda = subtotal * (descuentoPct / 100);
    const neto = subtotal - descuentoMoneda;
    const impuesto = neto * 0.15;
    const total = neto + impuesto;
    i.value = impuesto.toFixed(2);
    t.value = total.toFixed(2);
  }

  d.addEventListener('input', calcular);
  s.addEventListener('input', calcular);
});
@endforeach

// Recalculo en inserción
document.addEventListener('DOMContentLoaded', function () {
  const s = document.getElementById('insert_subtotal');
  const d = document.getElementById('insert_descuento');
  const t = document.getElementById('insert_total');
  const i = document.getElementById('insert_impuesto');

  function calcularInsert() {
    const subtotal = parseFloat(s.value) || 0;
    const descuentoPct = parseFloat(d.value) || 0;
    const descuentoMoneda = subtotal * (descuentoPct / 100);
    const neto = subtotal - descuentoMoneda;
    const impuesto = neto * 0.15;
    const total = neto + impuesto;
    i.value = impuesto.toFixed(2);
    t.value = total.toFixed(2);
  }

  s.addEventListener('input', calcularInsert);
  d.addEventListener('input', calcularInsert);
});
</script>
@stop
