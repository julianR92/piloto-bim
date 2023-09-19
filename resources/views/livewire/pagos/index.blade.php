@extends('layouts.main')

@section('content')
@php setlocale(LC_MONETARY, 'es_CO'); @endphp
<style>
.input-money {
  font-size: 18px; 
  font-weight: 700; 
}
.total-factura {
  font-size: 2.5rem; /* Tamaño de la letra */
  font-weight: bold; /* Negrita */
  color: #131212; /* Color del texto (puedes personalizarlo) */
  margin-bottom: 10px; /* Espacio inferior para separar del contenido */
  margin-left: 10px; /* Espacio inferior para separar del contenido */
}
</style>
<div>
    {{-- Be like water. --}}
    <div>
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#">Procedimientos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pago Procedimientos</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Administración de Procedimientos</h1>
            </div>   
            <div>
                
                {{-- <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M7 22q-.825 0-1.413-.588T5 20q0-.825.588-1.413T7 18q.825 0 1.413.588T9 20q0 .825-.588 1.413T7 22Zm10 0q-.825 0-1.413-.588T15 20q0-.825.588-1.413T17 18q.825 0 1.413.588T19 20q0 .825-.588 1.413T17 22ZM12 9.5q-.425 0-.713-.288T11 8.5q0-.425.288-.713T12 7.5q.425 0 .713.288T13 8.5q0 .425-.288.713T12 9.5ZM11 6V1h2v5h-2ZM7 17q-1.125 0-1.725-.988T5.25 14.05L6.6 11.6L3 4H1V2h3.275l4.25 9h7.025l3.875-7l1.75.95l-3.875 7q-.275.5-.725.775T15.55 13H8.1L7 15h12v2H7Z"/></svg>Crear Producto
                </a> --}}
            </div>         
        </div>
        <div class="row mt-4">
            <div class="col-md-5">
            <div class="form-group mb-2">
                <label for="documento">Numero de documento</label>
                <div>
                <div class="input-group">                                
                    <input name="documento" type="text" class="form-control border-gray-300"  autocomplete="off" placeholder="Ej: 10956123131" id="documento" required data-pristine-required-message="Campo Requerido"  onkeypress="return Numeros(event)" autofocus>
                   
                </div>
                <div id="suggestions" class="list-group"></div>
                </div>
            </div>
        </div>
            <div class="col-md-3 mt-4">
            <div class="form-group mt-1">
                <button type="button" class="btn btn-primary d-inline-flex align-items-center btnSearch">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="m15.45 15.05l1.1-1.05l-2.1-2.1q.275-.425.413-.9T15 10q0-1.475-1.038-2.488T11.5 6.5q-1.425 0-2.463 1.012T8 10q0 1.475 1.038 2.488T11.5 13.5q.525 0 .988-.138t.912-.412l2.05 2.1ZM11.5 12q-.825 0-1.413-.588T9.5 10q0-.825.588-1.413T11.5 8q.8 0 1.4.588T13.5 10q0 .825-.588 1.413T11.5 12ZM2 21q-.425 0-.713-.288T1 20q0-.425.288-.713T2 19h20q.425 0 .713.288T23 20q0 .425-.288.713T22 21H2Zm2-3q-.825 0-1.413-.588T2 16V5q0-.825.588-1.413T4 3h16q.825 0 1.413.588T22 5v11q0 .825-.588 1.413T20 18H4Zm0-2h16V5H4v11Zm0 0V5v11Z"/></svg>
                    &nbsp;&nbsp;Buscar
                </button>

            </div>
        </div>
        </div>
    </div>
     
    
    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="table-responsive div-table d-none">
                <table class="table table-centered table-nowrap mb-0 rounded" id="myTable" data-toggle="table" data-search="true" data-pagination="true" data-page-size="5" >
                    <thead class="thead-light">
                        <tr>
                            <th data-field="id" data-sortable="true" class="border-0 rounded-start">#</th>
                            <th data-field="nombre" class="border-0">Nombres</th>
                            <th data-field="date" class="border-0">Fecha y Hora</th>
                            <th data-field="tipoServicio" class="border-0">Tipo-Servicio</th>
                            <th data-field="abono" class="border-0">Abono</th>                           
                            <th class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>                   
                </table>
            </div>
            
            <form action="#" method="" id="myForm" class="d-none">                      
            <div class="row">  
                <div class="col-md-6 mt-2 mb-2">
                <h3>Pago de Servicios</h3> 
               </div> 
                 <div class="col-md-6">
                    <div class="d-flex justify-content-end">                      
                        <button type="button" class="btn btn-danger btn-sm btnClose"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="btnClose"><path class="btnClose" fill="none" stroke="#f5f5f5" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21l-9-9m0 0L3 3m9 9l9-9m-9 9l-9 9"/></svg></button>
                      </div>
                 </div>                
                    <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="nombre">Nombre*</label>
                        <div>
                        <div class="input-group">                                
                            <input name="nombre" type="text" class="form-control border-gray-300 input-money" id="nombre" required data-pristine-required-message="Campo Requerido" onkeyup="aMayusculas(this.value,this.id)" onkeypress="return Numeros(event)" readonly>
                            @error('nombre') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <label for="servicio_id">Servicio*</label>
                        <div>
                        <div class="input-group">                                
                            <select name="servicio_id" id="servicio_id" class="form-control form-select  select" required data-pristine-required-message="Campo Requerido">
                                <option value="">Seleccione..</option>
                                @foreach($servicios as $servi)
                                <option value={{$servi->id}}>{{ $servi->servicio}}</option>
                            @endforeach
                            </select>
                            @error('servicio_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <label for="talla_id">Talla*</label>
                        <div>
                        <div class="input-group">                                
                            <select name="talla_id" id="talla_id" class="form-control form-select  select" required data-pristine-required-message="Campo Requerido">
                                <option value="">Seleccione..</option>
                                @foreach($tallas as $talla)
                                <option value={{$talla->id}}>{{ $talla->talla}}</option>
                            @endforeach
                            </select>
                            @error('talla_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                        </div>
                        </div>
                    </div>
                </div>               
                <div class="col-md-3">
                <div class="form-group mb-4">
                    <label for="permiso">Precio *</label>
                    <div class="input-group">
                        <span class="input-group-text border-gray-300" id="basic-addon3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M128 20a108 108 0 1 0 108 108A108.12 108.12 0 0 0 128 20Zm0 192a84 84 0 1 1 84-84a84.09 84.09 0 0 1-84 84Zm44-64a32 32 0 0 1-32 32v4a12 12 0 0 1-24 0v-4h-12a12 12 0 0 1 0-24h36a8 8 0 0 0 0-16h-24a32 32 0 0 1 0-64v-4a12 12 0 0 1 24 0v4h12a12 12 0 0 1 0 24h-36a8 8 0 0 0 0 16h24a32 32 0 0 1 32 32Z"/></svg>
                        </span>
                        <input name="precio_mostrar" type="text" class="form-control border-gray-300 input-money" id="precio_mostrar" required data-pristine-required-message="Campo Requerido" onkeypress="return Numeros(event)" readonly>
                        @error('precio_mostrar') <div class="invalid-feedback" > {{ $message }} </div> @enderror 
                    </div> 
                </div> 
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <label for="planes_id">Planes de Descuento</label>
                        <div>
                        <div class="input-group">                                
                            <select name="planes_id" id="planes_id" class="form-control form-select  select"  data-pristine-required-message="Campo Requerido">
                                <option value="">Seleccione..</option>
                                @foreach($descuentos as $descuento)
                                <option value={{$descuento->id}} data-descuento={{$descuento->descuento}}>{{ $descuento->plan}} - %{{$descuento->descuento}}</option>
                            @endforeach
                            </select>
                            @error('planes_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                <div class="form-group mb-4">
                    <label for="permiso">Abono</label>
                    <div class="input-group">
                        <span class="input-group-text border-gray-300" id="basic-addon3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M128 20a108 108 0 1 0 108 108A108.12 108.12 0 0 0 128 20Zm0 192a84 84 0 1 1 84-84a84.09 84.09 0 0 1-84 84Zm44-64a32 32 0 0 1-32 32v4a12 12 0 0 1-24 0v-4h-12a12 12 0 0 1 0-24h36a8 8 0 0 0 0-16h-24a32 32 0 0 1 0-64v-4a12 12 0 0 1 24 0v4h12a12 12 0 0 1 0 24h-36a8 8 0 0 0 0 16h24a32 32 0 0 1 32 32Z"/></svg>
                        </span>
                        <input name="abono_mostrar" type="text" class="form-control border-gray-300 input-money" id="abono_mostrar" required data-pristine-required-message="Campo Requerido" onkeypress="return Numeros(event)" readonly>
                        @error('abono_mostrar') <div class="invalid-feedback" > {{ $message }} </div> @enderror 
                    </div> 
                </div> 
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <label for="medio_pago">Medio de pago*</label>
                        <div>
                        <div class="input-group">                                
                            <select name="medio_pago" id="medio_pago" class="form-control form-select  select" required data-pristine-required-message="Campo Requerido">
                                <option value="">Seleccione..</option>
                                @foreach($medios_pago as $metodo)
                                <option value={{$metodo->medio_pago}}>{{ $metodo->medio_pago}}</option>
                            @endforeach
                            </select>
                            @error('medio_pago') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="presentacion"><h3>Total:</h3><span id="total_cuenta" class="total-factura"></span></label>
                        <div>                      
                        </div>
                    </div>
                </div>
                    
                                            
                    <!-- End of Form -->                        
                    <div class="d-grid">
                        <input type="hidden" name="cliente_id" id="cliente_id" required>                        
                        <input type="hidden" name="agenda_id" id="agenda_id" required>                        
                        <input type="hidden" name="comision" id="comision" required>                   
                        <input type="hidden" name="valor_precio" id="valor_precio" required>                       
                        <input type="hidden" name="valor_abono" id="valor_abono" required>                     
                        <input type="hidden" name="abonos_id" id="abonos_id" required>                       
                        <input type="hidden" name="valor_pagar" id="valor_pagar"required>
                        <button type="submit" class="btn btn-primary btnModal">Generar Pago</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- MODAL --}}
    {{-- <div class="modal fade" id="modalSignIn" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo-modal">Crear Producto</h2>
                             
                                  
                </div>
            </div>
        </div>
    </div>     --}}
</div>
</div>
@push('scripts-procedimientos')
<script src="{{asset('js/pagos.js')}}" type="module"></script>
@endpush


@endsection