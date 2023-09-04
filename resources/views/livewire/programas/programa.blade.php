@extends('layouts.main')

@section('content')

<style>
 
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
                <li class="breadcrumb-item"><a href="/programas">Programas</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$area->name}}</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">PROGRAMAS DE {{$area->name}}</h1>
            </div>   
            <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal7" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="#888888" d="M12 5q.425 0 .713-.288Q13 4.425 13 4t-.287-.713Q12.425 3 12 3t-.712.287Q11 3.575 11 4t.288.712Q11.575 5 12 5ZM5 21q-.825 0-1.413-.587Q3 19.825 3 19V5q0-.825.587-1.413Q4.175 3 5 3h4.175q.275-.875 1.075-1.438Q11.05 1 12 1q1 0 1.788.562q.787.563 1.062 1.438H19q.825 0 1.413.587Q21 4.175 21 5v14q0 .825-.587 1.413Q19.825 21 19 21Zm0-2h14V5h-2v1q0 .825-.587 1.412Q15.825 8 15 8H9q-.825 0-1.412-.588Q7 6.825 7 6V5H5v14Z"/></svg>Crear Programa
                </a>
            </div>         
        </div>
    </div>
     
    
    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded" id="myTablePro" data-toggle="table" data-search="true" data-pagination="true" data-page-size="5" >
                    <thead class="thead-light">
                        <tr>
                            <th data-field="id" data-sortable="true" class="border-0 rounded-start">#</th>
                            <th data-field="programa" class="border-0">Nombre Programa</th>
                            <th data-field="nombre_proceso" class="border-0">Proceso</th>
                            <th data-field="nombre_eje" class="border-0">Eje</th>
                            <th data-field="estado" class="border-0">Estado</th>
                            <th class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyEje">
                        @foreach($programas as $pro)
                         <tr>

                            <td>{{$pro->id}}</td>
                            <td>{{$pro->programa}}</td>
                            <td>{{$pro->nombre_proceso}}</td>
                            <td>{{$pro->nombre_eje}}</td>
                            <td> @if($pro->estado)
                                <button type="button" data-id="{{$pro->id}}" class="btn btn-success d-inline-flex align-items-center btn-sm btnEstado" title="activo">
                                    <svg width="16" height="16"   data-id="{{$pro->id}}" class="btnEstado" viewBox="0 0 24 24"><path fill="currentColor" d="M20 12a8 8 0 0 0-8-8a8 8 0 0 0-8 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8m2 0a10 10 0 0 1-10 10A10 10 0 0 1 2 12A10 10 0 0 1 12 2a10 10 0 0 1 10 10M10 9.5c0 .8-.7 1.5-1.5 1.5S7 10.3 7 9.5S7.7 8 8.5 8s1.5.7 1.5 1.5m7 0c0 .8-.7 1.5-1.5 1.5S14 10.3 14 9.5S14.7 8 15.5 8s1.5.7 1.5 1.5m-5 7.73c-1.75 0-3.29-.73-4.19-1.81L9.23 14c.45.72 1.52 1.23 2.77 1.23s2.32-.51 2.77-1.23l1.42 1.42c-.9 1.08-2.44 1.81-4.19 1.81Z"/></svg></button>                            
                                @else
                                <button type="button"  data-id="{{$pro->id}}" class="btn btn-danger d-inline-flex align-items-center btn-sm btnEstado" title="inactivo">
                                <svg width="16" height="16" data-id="{{$pro->id}}" class="btnEstado" viewBox="0 0 24 24"><path fill="currentColor" d="M20 12a8 8 0 0 0-8-8a8 8 0 0 0-8 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8m2 0a10 10 0 0 1-10 10A10 10 0 0 1 2 12A10 10 0 0 1 12 2a10 10 0 0 1 10 10m-6.5-4c.8 0 1.5.7 1.5 1.5s-.7 1.5-1.5 1.5s-1.5-.7-1.5-1.5s.7-1.5 1.5-1.5M10 9.5c0 .8-.7 1.5-1.5 1.5S7 10.3 7 9.5S7.7 8 8.5 8s1.5.7 1.5 1.5m2 4.5c1.75 0 3.29.72 4.19 1.81l-1.42 1.42C14.32 16.5 13.25 16 12 16s-2.32.5-2.77 1.23l-1.42-1.42C8.71 14.72 10.25 14 12 14Z"/></svg>
                                </button>
                            
                            
                            @endif</td>
                            <td>
                            <button type="button" class="btn btn-success d-inline-flex align-items-center editarPrograma" data-id="{{$pro->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>
                            @canany(['control-total'])
                            <button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarPrograma" data-id="{{$pro->id}}">
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
    <div class="row">
        <div class="d-flex justify-content-end">
            <div class="col-md-2 pr-4">                             
                    <a href="/programas" class="text-info me-3 float-end"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3.97 12c0 4.41 3.62 8.03 8.03 8.03c4.41 0 8.03-3.62 8.03-8.03c0-4.41-3.62-8.03-8.03-8.03c-4.41 0-8.03 3.62-8.03 8.03M2 12C2 6.46 6.46 2 12 2s10 4.46 10 10s-4.46 10-10 10S2 17.54 2 12m8.46-1V8L6.5 12l3.96 4v-3h7.04v-2"/></svg>Atras</a></div>
            </div>       
    </div>
    {{-- MODAL --}}
    <div class="modal fade" id="modalSignIn" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar7" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo-pro">Crear Programa</h2>
                    <p class="text-center mb-4">Los Programas son la base de la Oferta Academica</p>
                    <form action="#" method="POST" id="myProgramForm">
                         
                        
                        <div class="form-group mb-2">
                            <label for="permiso">Nombre Programa*</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M172 120a44 44 0 1 1-44-44a44 44 0 0 1 44 44Zm60 8A104 104 0 1 1 128 24a104.2 104.2 0 0 1 104 104Zm-16 0a88 88 0 1 0-153.8 58.4a81.3 81.3 0 0 1 24.5-23a59.7 59.7 0 0 0 82.6 0a81.3 81.3 0 0 1 24.5 23A87.6 87.6 0 0 0 216 128Z"/></svg>
                                </span>
                                <input name="programa" type="text" class="form-control border-gray-300" placeholder="Ej: Tecnico Laboral en Artes Plasticas" id="programa" autofocus required data-pristine-required-message="Campo Requerido">
                                @error('programa') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                        
                        <div class="form-group mb-2">
                            <label for="permiso">Eje*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="eje_id" id="eje_id" class="form-control form-select  select" required data-pristine-required-message="Campo Requerido">
                                    <option value="">Seleccione..</option>
                                    @foreach($ejes as $eje)
                                        <option value={{$eje->id}}>{{ $eje->descripcion }}</option>
                                    @endforeach
                                </select>
                                @error('proceso') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                       
                        <div class="form-group mb-2">
                            <label for="permiso">Proceso*</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M10 9c-.55 0-1 .45-1 1s.45 1 1 1s1-.45 1-1s-.45-1-1-1zm0 4c-.55 0-1 .45-1 1s.45 1 1 1s1-.45 1-1s-.45-1-1-1zM7 9.5c-.28 0-.5.22-.5.5s.22.5.5.5s.5-.22.5-.5s-.22-.5-.5-.5zm3 7c-.28 0-.5.22-.5.5s.22.5.5.5s.5-.22.5-.5s-.22-.5-.5-.5zm-3-3c-.28 0-.5.22-.5.5s.22.5.5.5s.5-.22.5-.5s-.22-.5-.5-.5zm3-6c.28 0 .5-.22.5-.5s-.22-.5-.5-.5s-.5.22-.5.5s.22.5.5.5zM14 9c-.55 0-1 .45-1 1s.45 1 1 1s1-.45 1-1s-.45-1-1-1zm0-1.5c.28 0 .5-.22.5-.5s-.22-.5-.5-.5s-.5.22-.5.5s.22.5.5.5zm3 6c-.28 0-.5.22-.5.5s.22.5.5.5s.5-.22.5-.5s-.22-.5-.5-.5zm0-4c-.28 0-.5.22-.5.5s.22.5.5.5s.5-.22.5-.5s-.22-.5-.5-.5zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8s8 3.58 8 8s-3.58 8-8 8zm2-3.5c-.28 0-.5.22-.5.5s.22.5.5.5s.5-.22.5-.5s-.22-.5-.5-.5zm0-3.5c-.55 0-1 .45-1 1s.45 1 1 1s1-.45 1-1s-.45-1-1-1z"/></svg>
                                </span>
                                <input name="proceso" id="proceso" type="text" class="form-control border-gray-300" required data-pristine-required-message="Campo Requerido" readonly>
                                @error('proceso') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                            </div>

                            <div class="form-group mb-2">
                                <label for="duracion_programa">Duracion Semestres/Ciclos/Trimestres*</label>
                                <div>
                                <div class="input-group">                                
                                    <input name="duracion_programa" id="duracion_programa" type="text" class="form-control border-gray-300" data-pristine-type="integer" required data-pristine-required-message="Campo Requerido" placeholder='Ej: 6'>
                                    @error('duracion_programa') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                                </div>
                                </div>
                            </div>
                       
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="area_id" value="{{$area->id}}">
                            <input type="hidden" name="proceso_id" id="proceso_id">
                            <input type="hidden" name="id" id="idPrograma">
                            <button type="submit" class="btn btn-primary btnModal-pro">Crear Programa</button>
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>
    {{-- <div wire:ignore.self class="modal fade" id="modalPermisos" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar3" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo">Permisos del Rol</h2>
                    <p class="text-center mb-4">Permisos Asignados</p>
                    <div id="data-permisos"></div>
                              
                                  
                </div>
            </div>
        </div>
    </div> --}}
</div>
</div>
@push('programas-js')
<script src="{{asset('js/programas.js')}}" type="module"></script>
@endpush



@endsection