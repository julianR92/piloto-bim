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
                <li class="breadcrumb-item"><a href="#">Inventario</a></li>
                <li class="breadcrumb-item active" aria-current="page">Productos</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Administración de Productos</h1>
            </div>   
            <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M7 22q-.825 0-1.413-.588T5 20q0-.825.588-1.413T7 18q.825 0 1.413.588T9 20q0 .825-.588 1.413T7 22Zm10 0q-.825 0-1.413-.588T15 20q0-.825.588-1.413T17 18q.825 0 1.413.588T19 20q0 .825-.588 1.413T17 22ZM12 9.5q-.425 0-.713-.288T11 8.5q0-.425.288-.713T12 7.5q.425 0 .713.288T13 8.5q0 .425-.288.713T12 9.5ZM11 6V1h2v5h-2ZM7 17q-1.125 0-1.725-.988T5.25 14.05L6.6 11.6L3 4H1V2h3.275l4.25 9h7.025l3.875-7l1.75.95l-3.875 7q-.275.5-.725.775T15.55 13H8.1L7 15h12v2H7Z"/></svg>Crear Producto
                </a>
            </div>         
        </div>
    </div>
     
    
    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded" id="myTable" data-toggle="table" data-search="true" data-pagination="true" data-page-size="5" >
                    <thead class="thead-light">
                        <tr>
                            <th data-field="id" data-sortable="true" class="border-0 rounded-start">#</th>
                            <th data-field="nombre" class="border-0">Nombre</th>
                            <th data-field="tipo" class="border-0">Tipo</th>
                            <th data-field="presentacion" class="border-0">Presentacion</th>
                            <th data-field="valor_unitario" class="border-0">Valor Unitario</th>
                           
                            <th class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyColectivo">
                        @foreach($productos as $producto)
                         <tr>
                            <td>{{$producto->id}}</td>
                            <td>{{$producto->nombre}}</td>
                            <td>{{$producto->tipo}}</td>
                            <td>{{$producto->presentacion}}</td>
                            <td id="format">{{$producto->valor_unitario}}</td>
                            <td>
                            <button type="button" class="btn btn-success d-inline-flex align-items-center editarData" data-id="{{$producto->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>
                                @canany(['control-total'])
                            <button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarData" data-id="{{$producto->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>
                                @endcanany
                            </td>
                         </tr>
                        @endforeach
                     
                    </tbody>
                </table>
            </div>
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
                            <div class="input-group">                                
                                <select name="tipo" id="tipo" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido" >
                                    <option value="">Seleccione..</option>
                                    @foreach($tipos as $key=>$value)
                                    <option value={{$value}}>{{ $value}}</option>
                                @endforeach
                                </select>
                                @error('tipo') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
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
@push('scripts-inventarios')
<script src="{{asset('js/productos.js')}}" type="module"></script>
@endpush


@endsection