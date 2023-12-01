@extends('layouts.main')

@section('content')

<div>
    {{-- Be like water. --}}
    <div class="px-4">
    <div class="py-4 px-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#">Modulo de Seguimiento </a></li>
                <li class="breadcrumb-item active" aria-current="page">Proyectos</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Administración de Proyectos</h1>
            </div>   
            {{-- <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 14 14"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><rect width="3.5" height="3.5" x=".5" y="10" rx=".5"/><rect width="3.5" height="3.5" x="10" y="10" rx=".5"/><rect width="4" height="4" x="5" y=".5" rx=".5"/><path d="M4 12h6M5.09 4.29L2.5 10m6.41-5.71L11.5 10"/></g></svg>Crear Metodologia
                </a>
            </div>          --}}
        </div>
    </div>

    <div class="card border-0 shadow mb-5">
        <div class="card-body">
            <div class="table-responsive" style="overflow-x:inherit!important;">
                <h4 class="h5 text-bold mb-2">Agrega tu Proyecto</h4>
                <form action="#" method="" id="myForm"> 
                    <div class="row">                       
                       <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="nombre_fase">Nombre del proyecto *</label>
                        <div class="input-group">
                            <span class="input-group-text border-gray-300" id="basic-addon3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 8h18V4H3v4Zm0 6h18v-4H3v4Zm0 6h18v-4H3v4ZM4 7V5h2v2H4Zm0 6v-2h2v2H4Zm0 6v-2h2v2H4Z"/></svg>
                            </span>
                            <textarea style="resize: none;" name="descripcion"  class="form-control border-gray-300" placeholder="Ej: PROYECTO DE CONSTRUCCION DE VIVIENDA" id="descripcion" required data-pristine-required-message="Campo Requerido" maxlength="100" onkeyup="aMayusculas(this.value,this.id)" onkeypress="return NumDoc(event)"></textarea>
                            @error('descripcion') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                        </div> 
                    </div>  
                    </div> 
                    
                    <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="metodologia_id">Escoge la metodologia*</label>
                        <div>
                        <div class="input-group">                                
                            <select name="metodologia_id" id="metodologia_id" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido">
                                <option value="">Seleccione..</option>
                                @foreach($metodologias as $metodo)
                                <option value={{$metodo->id}}>{{ $metodo->descripcion }}</option>
                            @endforeach
                            </select>
                            @error('metodologia_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                        </div>
                        </div>
                    </div>
                    </div>
                     
                  
                    
                    <div class="col-md-12">
                    <div class="d-grid mt-3">
                        <input type="hidden" name="id" id="id">
                        <button type="submit" class="btn btn-info btnModal">Crear Proyecto</button>
                    </div>
                </div>
                </div>
               </form> 
            </div>
        </div>
    </div>
     
    
    <div class="card border-0 shadow mb-4" id="listarProyectos">
        <div class="card-body">
            <div class="table-responsive">
                <h4 class="h5 text-bold">Listar Proyectos</h4>
                <table class="table table-centered table-nowrap mb-0 rounded" id="myTable" data-toggle="table" data-search="true" data-pagination="true" data-page-size="10" >
                    <thead class="thead-light">
                        <tr>
                            <th data-field="id" data-sortable="true" class="border-0 text-center rounded-start">#</th>                       
                            <th data-field="descripcion" class="border-0 text-center">Descripcion</th>                                               
                            <th data-field="metodologia" class="border-0 text-center">Metodologia</th>                                               
                            <th data-field="estado" class="border-0 text-center">Estado</th>                      
                            {{-- <th class="border-0 text-center">Acciones</th> --}}
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyColectivo">
                        {{-- @foreach($descuentos as $sale)
                         <tr>
                            <td>{{$sale->id}}</td>
                            <td>{{$sale->plan}}</td>
                            <td>{{$sale->descuento}}%</td>
                            <td>{{$sale->estado ? 'Activo ✔️' : ' Inactivo ❌'}}</td>
                            <td>
                            <button type="button" class="btn btn-success d-inline-flex align-items-center editarData" data-id="{{$sale->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>
                                @canany(['control-total'])
                            <button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarData" data-id="{{$sale->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>
                                @endcanany
                            </td>
                         </tr>
                        @endforeach --}}
                     
                    </tbody>
                </table>
            </div>
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
                    <h2 class="h4 text-center titulo-modal">Crear Proyecto</h2>
                    <form action="#" method="" id="myForm">                        
                       
                        <div class="form-group mb-2">
                            <label for="nombre_fase">Nombre Metodologia *</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path d="M5 15.5L7.5 20h-5L5 15.5M9 19h12v-2H9v2zM5 9.5L7.5 14h-5L5 9.5M9 13h12v-2H9v2zM5 3.5L7.5 8h-5L5 3.5M9 7h12V5H9v2z" fill="currentColor"/></svg>
                                </span>
                                <input name="descripcion" type="text" class="form-control border-gray-300" placeholder="Ej: METODOLOGIA MIXTA" id="descripcion" required data-pristine-required-message="Campo Requerido" maxlength="100" onkeyup="aMayusculas(this.value,this.id)" onkeypress="return NumDoc(event)" autofocus>
                                @error('descripcion') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div>   
                        
                        <div class="form-group mb-2">
                            <label for="estado">Estado*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="estado" id="estado" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido">
                                    <option value="">Seleccione..</option>
                                    <option value="1">ACTIVO</option>
                                    <option value="2">INACTIVO</option>
                                </select>
                                @error('estado') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                                       
                        
                        <!-- End of Form -->                        
                        <div class="d-grid mt-3">
                            <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-info btnModal">Crear Metodologia</button>
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>    
        --}}
</div>
</div>
@push('scripts-seguimiento')
<script src="{{asset('js/proyectos.js')}}" type="module"></script>
@endpush


@endsection