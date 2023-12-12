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
                <li class="breadcrumb-item active" aria-current="page">Indicadores</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Administración de Indicadores</h1>
            </div>   
            <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 20q-.825 0-1.413-.588T7 18q0-.825.588-1.413T9 16q.825 0 1.413.588T11 18q0 .825-.588 1.413T9 20Zm6 0q-.825 0-1.413-.588T13 18q0-.825.588-1.413T15 16q.825 0 1.413.588T17 18q0 .825-.588 1.413T15 20Zm-6-6q-.825 0-1.413-.588T7 12q0-.825.588-1.413T9 10q.825 0 1.413.588T11 12q0 .825-.588 1.413T9 14Zm6 0q-.825 0-1.413-.588T13 12q0-.825.588-1.413T15 10q.825 0 1.413.588T17 12q0 .825-.588 1.413T15 14ZM9 8q-.825 0-1.413-.588T7 6q0-.825.588-1.413T9 4q.825 0 1.413.588T11 6q0 .825-.588 1.413T9 8Zm6 0q-.825 0-1.413-.588T13 6q0-.825.588-1.413T15 4q.825 0 1.413.588T17 6q0 .825-.588 1.413T15 8Z"/></svg>Crear Indicador
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
                            <th data-field="nombre_indicador" class="border-0 text-center">Nombre Indicador</th>
                            <th data-field="descripcion" class="border-0 text-center">Descripción</th>
                            <th data-field="valor" class="border-0 text-center">Valor</th>
                            <th data-field="valor" class="border-0 text-center">Formula</th>
                            <th data-field="valor" class="border-0 text-center">Periocidad (meses)</th>
                            <th data-field="valor" class="border-0 text-center">Bueno</th>
                            <th data-field="valor" class="border-0 text-center">Regular</th>
                            <th data-field="valor" class="border-0 text-center">Bajo</th>
                                                 
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
                <div class="modal-body px-md-4">
                    <h2 class="h4 text-center titulo-modal">Crear Indicador</h2>
                    <form action="#" method="" id="myForm">                        
                       
                        <div class="form-group mb-2">
                            <label for="nombre_indicador">Nombre Indicador *</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path d="M5 15.5L7.5 20h-5L5 15.5M9 19h12v-2H9v2zM5 9.5L7.5 14h-5L5 9.5M9 13h12v-2H9v2zM5 3.5L7.5 8h-5L5 3.5M9 7h12V5H9v2z" fill="currentColor"/></svg>
                                </span>
                                <input name="nombre_indicador" type="text" class="form-control border-gray-300" placeholder="Ej: Cumplimiento de Plazos" id="nombre_indicador" required data-pristine-required-message="Campo Requerido" maxlength="100" onkeyup="aMayusculas(this.value,this.id)" onkeypress="return NumDoc(event)">
                                @error('nombre_indicador') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                        <div class="form-group mb-2">
                            <label for="descripcion">Descripcion *</label>
                            <div class="input-group">                               
                                <textarea name="descripcion" type="text" class="form-control border-gray-300" placeholder="Ej: Esta indicador consiste en ..." id="descripcion" rows="3" required data-pristine-required-message="Campo Requerido" onkeyup="aMayusculas(this.value,this.id)" onkeypress="return Letras(event)" maxlenght="255" style="resize: none"></textarea>
                                @error('descripcion') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                        <div class="form-group mb-2">
                            <div class="row">    
                                <div class="col-md-6">    
                                    <label for="permiso">Valor *<small>(Equivale en %)</small></label>
                                    <div class="input-group">
                                        <span class="input-group-text border-gray-300" id="basic-addon3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M17.503 4.498L4.499 17.503a1.411 1.411 0 0 0 1.996 1.996L19.499 6.495a1.412 1.412 0 0 0-1.996-1.997zM7.002 5a2 2 0 1 0-.004 4a2 2 0 0 0 .004-4zm10 10a2 2 0 1 0-.004 4a2 2 0 0 0 .004-4z"/></svg>
                                        </span>
                                        <input name="valor" type="text" class="form-control border-gray-300" placeholder="Ej: 30" id="valor" required data-pristine-required-message="Campo Requerido" onkeypress="return Numeros(event)" data-pristine-type="integer" maxlength=3 minlength="1" max="100">
                                        @error('valor') <div class="invalid-feedback" > {{ $message }} </div> @enderror 
                                    </div> 
                                </div>
                                <div class="col-md-6">    
                                    <label for="periocidad">Periocidad (meses) *</label>
                                    <div class="input-group">                                
                                        <select name="periocidad" id="periocidad" class="form-control form-select  select" required data-pristine-required-message="Campo Requerido" >
                                            <option value="">Seleccione..</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                        @error('periocidad') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                                    </div>
                                </div> 
                            </div>
                        </div> 
                        <div class="form-group mb-3">
                            <label for="formula">Formula *</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M7 13v-1h2.82c-.07-.47-.16-.9-.25-1.3c-.19-.88-.36-1.7-.32-2.7c.08-1.82.67-3.07 1.78-3.73c1.68-1.02 4.02-.27 4.97.09l-.15 1.01c-.64-.27-2.89-1.1-4.31-.24c-.8.47-1.23 1.45-1.29 2.87c-.04.9.12 1.64.3 2.5c.1.45.2.94.29 1.5H15v1h-4.05c.05.38.05.8.05 1.25C11 17.43 9.53 19 8.35 20H17v1H6.5v-1l.81-.43c1.13-.95 2.69-2.24 2.69-5.32c0-.45 0-.87-.05-1.25H7Z"/></svg>
                                </span>
                                <input name="formula" type="text" class="form-control border-gray-300" placeholder="Ej: formula abc" id="formula" required data-pristine-required-message="Campo Requerido">
                                @error('formula') <div class="invalid-feedback" > {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                        <p class="mb-1 text-decoration-underline">Umbral de calificación</p>
                        <div class="form-group mb-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="bueno">Bueno *</label>
                                    <div class="input-group">
                                        <input name="bueno" type="text" class="form-control border-gray-300" placeholder="Ej: >80" id="bueno" required data-pristine-required-message="Campo Requerido">
                                        @error('bueno') <div class="invalid-feedback" > {{ $message }} </div> @enderror 
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <label for="regular">Regular *</label>
                                    <div class="input-group">
                                        <input name="regular" type="text" class="form-control border-gray-300" placeholder="Ej: >50, <80" id="regular" required data-pristine-required-message="Campo Requerido">
                                        @error('regular') <div class="invalid-feedback" > {{ $message }} </div> @enderror 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="bajo">Bajo *</label>
                                    <div class="input-group">
                                        <input name="bajo" type="text" class="form-control border-gray-300" placeholder="Ej: <50" id="bajo" required data-pristine-required-message="Campo Requerido">
                                        @error('bajo') <div class="invalid-feedback" > {{ $message }} </div> @enderror 
                                    </div>
                                </div>
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
</div>
</div>
@push('scripts-gestion')
<script src="{{asset('js/indicadores.js')}}" type="module"></script>
@endpush


@endsection