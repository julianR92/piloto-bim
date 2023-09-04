@extends('layouts.main')

@section('content')

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
                <li class="breadcrumb-item active" aria-current="page">Servicios</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Administración de servicios</h1>
            </div>   
            <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M10 12.73A70.39 70.39 0 0 0 17 11V4s-6.5-2-9.5-2a5.5 5.5 0 0 0-1.38 10.82L7 19h1a3 3 0 0 0 1.46 2.33A3.15 3.15 0 0 1 11 24h1a4.12 4.12 0 0 0-1.91-3.45C9.39 20 9 19.63 9 19h1M4 7.5A3.5 3.5 0 0 1 7.5 4A37.08 37.08 0 0 1 15 5.5v4A37.08 37.08 0 0 1 7.5 11A3.5 3.5 0 0 1 4 7.5M22 9a4.32 4.32 0 0 1-2.22-.55A3.4 3.4 0 0 0 18 8V7a4.32 4.32 0 0 1 2.22.55A3.4 3.4 0 0 0 22 8m0-2a3.4 3.4 0 0 1-1.78-.45A4.32 4.32 0 0 0 18 5v1a3.4 3.4 0 0 1 1.78.45A4.32 4.32 0 0 0 22 7m0 3a3.4 3.4 0 0 1-1.78-.45A4.32 4.32 0 0 0 18 9v1a3.4 3.4 0 0 1 1.78.45A4.32 4.32 0 0 0 22 11M9 7.5A1.5 1.5 0 1 1 7.5 6A1.5 1.5 0 0 1 9 7.5Z"/></svg>Crear Servicio
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
                            <th data-field="tipo_servicio" class="border-0">Tipo de Servicio</th>
                            <th data-field="servicio" class="border-0">Servicio</th>
                            <th class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyColectivo">
                        @foreach($servicio as $servi)
                         <tr>
                            <td>{{$servi->id}}</td>
                            <td>{{$servi->tipo_servicio}}</td>
                            <td>{{$servi->servicio}}</td>
                            <td>
                            <button type="button" class="btn btn-success d-inline-flex align-items-center editarData" data-id="{{$servi->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>
                                @canany(['control-total'])
                            <button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarData" data-id="{{$servi->id}}">
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
                    <h2 class="h4 text-center titulo-modal">Crear Tipo servicio</h2>
                    <form action="#" method="" id="myForm">
                        
                        <div class="form-group mb-2">
                            <label for="tipo_servicio_id">Tipo de servicio*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="tipo_servicio_id" id="tipo_servicio_id" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido" autofocus>
                                    <option value="">Seleccione..</option>
                                    @foreach($tipo_servicio as $tipo)
                                        <option value={{$tipo->id}}>{{ $tipo->tipo_servicio }}</option>
                                    @endforeach
                                </select>
                                @error('tipo_servicio_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="permiso">Servicio *</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M172 120a44 44 0 1 1-44-44a44 44 0 0 1 44 44Zm60 8A104 104 0 1 1 128 24a104.2 104.2 0 0 1 104 104Zm-16 0a88 88 0 1 0-153.8 58.4a81.3 81.3 0 0 1 24.5-23a59.7 59.7 0 0 0 82.6 0a81.3 81.3 0 0 1 24.5 23A87.6 87.6 0 0 0 216 128Z"/></svg>
                                </span>
                                <input name="servicio" type="text" class="form-control border-gray-300" placeholder="Ej: Botulinica" id="servicio" required data-pristine-required-message="Campo Requerido">
                                @error('servicio') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-primary btnModal">Crear Tipo de Servicio</button>
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>    
</div>
</div>
@push('scripts-parametrizacion')
<script src="{{asset('js/servicio.js')}}" type="module"></script>
@endpush


@endsection