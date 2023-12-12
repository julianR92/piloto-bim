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
                <li class="breadcrumb-item"><a href="#">Modulo de Gestión </a></li>
                <li class="breadcrumb-item active" aria-current="page">Fases</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Administración de Fases</h1>
            </div>   
            <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path d="M5 15.5L7.5 20h-5L5 15.5M9 19h12v-2H9v2zM5 9.5L7.5 14h-5L5 9.5M9 13h12v-2H9v2zM5 3.5L7.5 8h-5L5 3.5M9 7h12V5H9v2z" fill="currentColor"/></svg>Crear Fase
                </a>
            </div>         
        </div>
    </div>
     
    
    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded" id="myTable" data-toggle="table" data-search="true" data-pagination="true" data-page-size="10" >
                    <thead class="thead-light">
                        <tr>
                            <th data-field="id" data-sortable="true" class="border-0 text-center rounded-start">#</th>
                            <th data-field="nombre_fase" class="border-0 text-center">Nombre Fase</th>
                            <th data-field="descripcion" class="border-0 text-center">Descripcion</th>
                            <th data-field="duracion" class="border-0 text-center">Duracion</th>  
                            <th data-field="metodologia" class="border-0 text-center">Metodologia</th>                     
                            <th data-field="responsable" class="border-0 text-center">Responsable</th>
                            <th data-field="hitos" class="border-0 text-center">Hitos</th>                      
                            <th class="border-0 text-center">Acciones</th>
                           
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
    <div class="modal fade" id="modalSignIn" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo-modal">Crear Fase</h2>
                    <form action="#" method="" id="myForm">                        
                       
                        <div class="form-group mb-2">
                            <label for="nombre_fase">Nombre Fase *</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path d="M5 15.5L7.5 20h-5L5 15.5M9 19h12v-2H9v2zM5 9.5L7.5 14h-5L5 9.5M9 13h12v-2H9v2zM5 3.5L7.5 8h-5L5 3.5M9 7h12V5H9v2z" fill="currentColor"/></svg>
                                </span>
                                <input name="nombre_fase" type="text" class="form-control border-gray-300" placeholder="Ej: FASE DE ADQUISICION" id="nombre_fase" required data-pristine-required-message="Campo Requerido" maxlength="100" onkeyup="aMayusculas(this.value,this.id)" onkeypress="return NumDoc(event)">
                                @error('nombre_fase') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                        <div class="form-group mb-2">
                            <label for="descripcion">Descripcion *</label>
                            <div class="input-group">                               
                                <textarea name="descripcion" type="text" class="form-control border-gray-300" placeholder="Ej: Esta fase consiste en ..." id="descripcion" rows="3" required data-pristine-required-message="Campo Requerido" onkeyup="aMayusculas(this.value,this.id)" onkeypress="return Letras(event)" maxlenght="255" style="resize: none"></textarea>
                                @error('descripcion') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                        <div class="form-group mb-4">
                            <label for="descripcion">Duracion(en dias) *</label>
                            <div class="input-group">                               
                                <input name="duracion" type="text" class="form-control border-gray-300" placeholder="Ej: 10" id="duracion" required data-pristine-required-message="Campo Requerido" onkeypress="return Numeros(event)" data-pristine-type="integer" maxlength="6">
                                @error('duracion') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                         <div class="form-group mb-4">
                            <label for="descripcion">Metodologia*</label>
                            <div class="input-group">                                
                                <select name="metodologia_id" id="metodologia_id" class=" form-control form-select  select" data-pristine-required-message="Campo Requerido" required>
                                    <option value="">Seleccione..</option>
                                    @foreach($metodologias as $metodologia)
                                        <option value={{$metodologia->id}}>{{ $metodologia->descripcion }} </option>
                                    @endforeach
                                </select>
                                @error('metodologia_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                        </div> 
                         <div class="form-group mb-4">
                            <label for="descripcion">Responsable</label>
                            <div class="input-group">                                
                                <select name="responsable_id" id="responsable_id" class=" form-control form-select  select" >
                                    <option value="">Seleccione..</option>
                                    @foreach($responsables as $responsable)
                                        <option value={{$responsable->id}}>{{ $responsable->first_name }} {{ $responsable->last_name }} <small style="font-size:8px!important;">user: {{$responsable->email}}</small></option>
                                    @endforeach
                                </select>
                                @error('responsable_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                        </div> 
                        
                        
                        
                        <!-- End of Form -->                        
                        <div class="d-grid mt-3">
                            <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-info btnModal">Crear Fase</button>
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>    
    <div class="modal fade" id="modalStructure" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar-structure" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5 " style="text-align: center;">
                    <h2 class="h4 text-center">Estructura</h2>
                    <div id="myDiagram" class="d-flex justify-content-center align-items-center" style="width: 100%; height: 400px;"></div>                          
                </div>
            </div>
        </div>
    </div>    
</div>
</div>
@push('scripts-gestion')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gojs/2.1.18/go-debug.js"></script>
<script src="{{asset('js/fases.js')}}" type="module"></script>
@endpush


@endsection