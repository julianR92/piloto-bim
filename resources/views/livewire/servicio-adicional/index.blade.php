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
                <li class="breadcrumb-item"><a href="#">Parametrización</a></li>
                <li class="breadcrumb-item active" aria-current="page">Servicios Adicionales</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Administración de Servicios Adicionales</h1>
            </div>   
            <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M15.5 6.5C15.5 5.66 17 4 17 4s1.5 1.66 1.5 2.5c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5m4 8.5a2.5 2.5 0 0 0 2.5-2.5c0-1.67-2.5-4.5-2.5-4.5S17 10.83 17 12.5a2.5 2.5 0 0 0 2.5 2.5M13 14h-2v-2H9v2H7v2h2v2h2v-2h2v-2m3-2v10H4V12c0-2.97 2.16-5.43 5-5.91V4H7V2h6c1.13 0 2.15.39 3 1l-1.44 1.44C14.1 4.17 13.57 4 13 4h-2v2.09c2.84.48 5 2.94 5 5.91Z"/></svg>Crear Servicio Adicional
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
                            <th data-field="valor" class="border-0">Valor</th>
                            <th data-field="comision" class="border-0">Comision</th>
                            <th class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyColectivo">
                        @foreach($servicios as $servi)
                         <tr>
                            <td>{{$servi->id}}</td>
                            <td>{{$servi->nombre}}</td>                           
                            <td id="format">{{$servi->valor}}</td>
                            <td id="format2">{{$servi->comision}}</td>
                            <td>
                            <button type="button" class="btn btn-success d-inline-flex align-items-center editarData" data-id="{{$servi->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>
                               
                            <button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarData" data-id="{{$servi->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>
                          
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
                    <h2 class="h4 text-center titulo-modal">Crear Servicio Adicional</h2>
                    <form action="#" method="" id="myForm">
                        
                        <div class="form-group mb-2">
                            <label for="nombre">Servicio Adicional *</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 48 48"><mask id="ipSHairDryer0"><g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"><path stroke="#fff" d="m19.193 21.544l2.319 18.552a3.473 3.473 0 0 1-6.892.862l-2.374-18.989"/><path fill="#fff" stroke="#fff" d="M13 4a9 9 0 0 0 0 18c1.578 0 3.74-.175 6.193-.456l12.403-2.022L44 17.5v-9L28.5 6.25L13 4Z"/><path stroke="#000" d="M37 8.2v9.6"/><path stroke="#fff" d="m44 17.5l-12.403 2.022M44 8.5L28.5 6.25"/><path fill="#000" stroke="#000" d="M16 13a3 3 0 1 1-6 0a3 3 0 0 1 6 0Z"/></g></mask><path fill="currentColor" d="M0 0h48v48H0z" mask="url(#ipSHairDryer0)"/></svg>
                                </span>
                                <input name="nombre" type="text" class="form-control border-gray-300" placeholder="Ej: Corte de cabello" id="nombre" maxlength="20" required data-pristine-required-message="Campo Requerido" onkeypress="return NumDoc(event)" onkeyup="aMayusculas(this.value,this.id)" >
                                @error('nombre') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div>                       
                        
                        <div class="form-group mb-4">
                            <label for="permiso">Valor *</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M128 20a108 108 0 1 0 108 108A108.12 108.12 0 0 0 128 20Zm0 192a84 84 0 1 1 84-84a84.09 84.09 0 0 1-84 84Zm44-64a32 32 0 0 1-32 32v4a12 12 0 0 1-24 0v-4h-12a12 12 0 0 1 0-24h36a8 8 0 0 0 0-16h-24a32 32 0 0 1 0-64v-4a12 12 0 0 1 24 0v4h12a12 12 0 0 1 0 24h-36a8 8 0 0 0 0 16h24a32 32 0 0 1 32 32Z"/></svg>
                                </span>
                                <input name="valor" type="text" class="form-control border-gray-300" placeholder="Ej: 120000" id="valor" required data-pristine-required-message="Campo Requerido" onkeypress="return Numeros(event)" data-pristine-type="integer">
                                @error('valor') <div class="invalid-feedback" > {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                        <div class="form-group mb-4">
                            <label for="permiso">Comision *</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M128 20a108 108 0 1 0 108 108A108.12 108.12 0 0 0 128 20Zm0 192a84 84 0 1 1 84-84a84.09 84.09 0 0 1-84 84Zm44-64a32 32 0 0 1-32 32v4a12 12 0 0 1-24 0v-4h-12a12 12 0 0 1 0-24h36a8 8 0 0 0 0-16h-24a32 32 0 0 1 0-64v-4a12 12 0 0 1 24 0v4h12a12 12 0 0 1 0 24h-36a8 8 0 0 0 0 16h24a32 32 0 0 1 32 32Z"/></svg>
                                </span>
                                <input name="comision" type="text" class="form-control border-gray-300" placeholder="Ej: 10000" id="comision" required data-pristine-required-message="Campo Requerido" onkeypress="return Numeros(event)" data-pristine-type="integer">
                                @error('comision') <div class="invalid-feedback" > {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-primary btnModal">Crear Servicio Adicional</button>
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>    
</div>
</div>
@push('scripts-parametrizacion')
<script src="{{asset('js/servicios-adicionales.js')}}" type="module"></script>
@endpush


@endsection