@extends('layouts.main')

@section('content')
@php setlocale(LC_MONETARY, 'es_CO'); @endphp
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
                <li class="breadcrumb-item active" aria-current="page">Cierre de Procedimientos</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Cierre de Procedimientos</h1>
            </div>   
            {{-- <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M7 22q-.825 0-1.413-.588T5 20q0-.825.588-1.413T7 18q.825 0 1.413.588T9 20q0 .825-.588 1.413T7 22Zm10 0q-.825 0-1.413-.588T15 20q0-.825.588-1.413T17 18q.825 0 1.413.588T19 20q0 .825-.588 1.413T17 22ZM12 9.5q-.425 0-.713-.288T11 8.5q0-.425.288-.713T12 7.5q.425 0 .713.288T13 8.5q0 .425-.288.713T12 9.5ZM11 6V1h2v5h-2ZM7 17q-1.125 0-1.725-.988T5.25 14.05L6.6 11.6L3 4H1V2h3.275l4.25 9h7.025l3.875-7l1.75.95l-3.875 7q-.275.5-.725.775T15.55 13H8.1L7 15h12v2H7Z"/></svg>Crear Producto
                </a>
            </div>          --}}
        </div>
    </div>
     
    
    <div class="card border-0 shadow mb-4" id="card-inicio">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded" id="myTable" data-toggle="table" data-search="true" data-pagination="true" data-page-size="5" >
                    <thead class="thead-light">
                        <tr>
                            <th data-field="id" data-sortable="true" class="border-0 rounded-start">#</th>
                            <th data-field="nombre" class="border-0">Nombres</th>
                            <th data-field="documento" class="border-0">Documento</th>
                            <th data-field="presentacion" class="border-0">Servicio</th>
                            <th data-field="valor_unitario" class="border-0">Fecha</th>
                           
                            <th class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyColectivo">
                        @foreach($procedimientos as $procedure)
                         <tr>
                            <td>{{$procedure->id}}</td>
                            <td>{{$procedure->nombres}} {{$procedure->apellidos}}</td>
                            <td>{{$procedure->documento}}</td>
                            <td>{{$procedure->servicio}}</td>
                            <td>{{$procedure->created_at}}</td>
                            <td>
                            <button type="button" class="btn btn-info d-inline-flex align-items-center closeProcedure" data-id="{{$procedure->id}}"  data-servicio="{{$procedure->servicio_id}}">                            
                                <svg xmlns="http://www.w3.org/2000/svg" class="closeProcedure" data-id="{{$procedure->id}}"  data-servicio="{{$procedure->servicio_id}}" width="16" height="16" viewBox="0 0 24 24"><path class="closeProcedure" data-id="{{$procedure->id}}"  data-servicio="{{$procedure->servicio_id}}"  d="M19 11.5s-2 2.167-2 3.5a2 2 0 0 0 4 0c0-1.333-2-3.5-2-3.5zm-4.281-1.52L5.207 10L10 5.208l4.719 4.771zm1.842-1.041L7.621 0L6.207 1.414l2.379 2.379l-5.147 5.146a1.502 1.502 0 0 0 0 2.122l5.5 5.5c.293.293.677.439 1.061.439c.384 0 .768-.146 1.061-.439l5.5-5.5a1.502 1.502 0 0 0 0-2.122z" fill="currentColor"/><path d="M0 20h24v4H0z" fill="currentColor"/></svg>Cerrar Procedimiento</button>
                                {{-- @canany(['control-total'])
                            <button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarData" data-id="{{$procedure->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>
                                @endcanany --}}
                            </td>
                         </tr>
                        @endforeach
                     
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card border-0 shadow mb-4 d-none" id="cardCierre">
        <div class="card-body" id="card-cierre">
            <form action="#" method="" id="myForm">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-end">                      
                            <button type="button" class="btn btn-danger btn-sm btnClose"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="btnClose"><path class="btnClose" fill="none" stroke="#f5f5f5" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21l-9-9m0 0L3 3m9 9l9-9m-9 9l-9 9"/></svg></button>
                          </div>
                        <h3 id="titulo"></h3>
                    </div>
                    <div class="col-md-6">                        
                    <div class="form-group mb-2">                       
                        <div>
                        <div class="form-check form-switch">                           
                            <label class="form-check-label" for="servicio_compartido">  ¿Fue un servicio compartido ?</label>
                            <input name="servicio_compartido" class="form-check-input" type="checkbox" id="servicio_compartido">
                            @error('servicio_compartido') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                        </div>
                        </div>
                    </div> 
                </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label for="tipo">Profesional #1*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="profesional_uno" id="profesional_uno" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido" >
                                    <option value="">Seleccione..</option>
                                    @foreach($profesionales as $profesional)
                                    <option value={{$profesional->id}}>{{ $profesional->nombres}} {{$profesional->apellidos}}</option>
                                @endforeach
                                </select>
                                @error('profesional_uno') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 divSecond d-none">
                        <div class="form-group mb-2">
                            <label for="tipo">Profesional #2*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="profesional_dos" id="profesional_dos" class=" form-control form-select  select" data-pristine-required-message="Campo Requerido">
                                    <option value="">Seleccione..</option>
                                    @foreach($profesionales as $profesional)
                                    <option value={{$profesional->id}}>{{ $profesional->nombres}} {{$profesional->apellidos}}</option>
                                @endforeach
                                </select>
                                @error('profesional_dos') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label for="tipo">¿De donde salio el producto?</label>
                            <div>
                            <div class="input-group">                                
                                <select name="profesional_producto" id="profesional_producto" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido">
                                    <option value="">Seleccione..</option>
                                    @foreach($profesionalesAll as $profesional)
                                    <option value={{$profesional->id}}>{{ $profesional->nombres}} {{$profesional->apellidos}}</option>
                                @endforeach
                                </select>
                                @error('profesional_producto') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="row divProducts">

                </div>
                <!-- End of Form -->                        
                <div class="d-grid mt-4">
                    <input type="hidden" name="id" id="id" required>                        
                    <input type="hidden" name="comision" id="comision" required>                       
                    <button type="submit" class="btn btn-primary btnCierre">Generar Cierre</button>
                </div>
            </form>

        </div>


    </div>
    {{-- MODAL --}}
    <div class="modal fade" id="modalSignIn" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo-modal">Crear Producto</h2>
                    <form action="#" method="" id="myForm">
                        
                      
                        <div class="form-group mb-2">
                            <label for="nombre">Nombre*</label>
                            <div>
                            <div class="input-group">                                
                                <input name="nombre" type="text" class="form-control border-gray-300" placeholder="Ej: ADN 3000" id="nombre" required data-pristine-required-message="Campo Requerido" onkeyup="aMayusculas(this.value,this.id)" onkeypress="return NumDoc(event)" autofocus>
                                @error('nombre') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="tipo">Tipo*</label>
                            <div>
                            {{-- <div class="input-group">                                
                                <select name="tipo" id="tipo" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido" >
                                    <option value="">Seleccione..</option>
                                    @foreach($tipos as $key=>$value)
                                    <option value={{$value}}>{{ $value}}</option>
                                @endforeach
                                </select>
                                @error('tipo') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> --}}
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="presentacion">Presentacion*</label>
                            <div>
                            <div class="input-group">                                
                                <input name="presentacion" type="text" class="form-control border-gray-300" placeholder="Ej: 350ml" id="presentacion" required data-pristine-required-message="Campo Requerido" onkeyup="aMayusculas(this.value,this.id)">
                                @error('presentacion') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="permiso">Valor Unitario *</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M128 20a108 108 0 1 0 108 108A108.12 108.12 0 0 0 128 20Zm0 192a84 84 0 1 1 84-84a84.09 84.09 0 0 1-84 84Zm44-64a32 32 0 0 1-32 32v4a12 12 0 0 1-24 0v-4h-12a12 12 0 0 1 0-24h36a8 8 0 0 0 0-16h-24a32 32 0 0 1 0-64v-4a12 12 0 0 1 24 0v4h12a12 12 0 0 1 0 24h-36a8 8 0 0 0 0 16h24a32 32 0 0 1 32 32Z"/></svg>
                                </span>
                                <input name="valor_unitario" type="text" class="form-control border-gray-300" placeholder="Ej: 120000" id="valor_unitario" required data-pristine-required-message="Campo Requerido" onkeypress="return Numeros(event)" data-pristine-type="integer">
                                @error('valor_unitario') <div class="invalid-feedback" > {{ $message }} </div> @enderror 
                            </div> 
                        </div>                         
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-primary btnModal">Crear Precio</button>
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>    
</div>
</div>
@push('scripts-procedimientos')
<script src="{{asset('js/pagos-cierre.js')}}" type="module"></script>
@endpush




@endsection