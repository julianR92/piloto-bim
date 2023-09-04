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
                <li class="breadcrumb-item"><a href="#">Pagos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Medios de Pago</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Medios de Pago</h1>
            </div>   
            <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 128 128"><defs><path id="notoV1CreditCard0" d="M125.76 64.91c2.32 2.99 2.04 6.61-.68 8.03l-82.41 43.15c-3.62 1.88-8.38.33-10.54-3.45L1.46 59.07c-1.79-3.13-.4-6.8 3.03-8.17l79.49-31.67c2.66-1.05 6.41.15 8.39 2.7l33.39 42.98z"/></defs><use fill="#fcc21b" href="#notoV1CreditCard0"/><clipPath id="notoV1CreditCard1"><use href="#notoV1CreditCard0"/></clipPath><path fill="#2f2f2f" d="M106.86 35.82L8.43 79.41L-.02 64.45l97.55-40.54z" clip-path="url(#notoV1CreditCard1)"/><path fill="#fff" d="M119.26 64.62c1.14 1.5.98 3.3-.4 3.99l-11.09 5.66c-1.43.73-3.54.05-4.68-1.51l-6.51-8.93c-1.09-1.51-.82-3.29.6-3.97l11.03-5.25c1.36-.65 3.36 0 4.48 1.44l6.57 8.57z"/></svg>Crear Medio de Pago
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
                            <th data-field="medio_pago" class="border-0">Medio Pago</th>
                            <th class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyColectivo">
                        @foreach($medios_pago as $medio)
                         <tr>
                            <td>{{$medio->id}}</td>
                            <td>{{$medio->medio_pago}}</td>
                            <td>
                            <button type="button" class="btn btn-success d-inline-flex align-items-center editarData" data-id="{{$medio->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>
                             
                            <button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarData" data-id="{{$medio->id}}">
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
                    <h2 class="h4 text-center titulo-modal">Crear Medio de pago</h2>
                    <form action="#" method="" id="myForm">                        
                        
                        <div class="form-group mb-4">
                            <label for="medio_pago">Nombre del medio Pago *</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M172 120a44 44 0 1 1-44-44a44 44 0 0 1 44 44Zm60 8A104 104 0 1 1 128 24a104.2 104.2 0 0 1 104 104Zm-16 0a88 88 0 1 0-153.8 58.4a81.3 81.3 0 0 1 24.5-23a59.7 59.7 0 0 0 82.6 0a81.3 81.3 0 0 1 24.5 23A87.6 87.6 0 0 0 216 128Z"/></svg>
                                </span>
                                <input name="medio_pago" type="text" class="form-control border-gray-300" placeholder="Ej: EFECTIVO" id="medio_pago" autofocus required data-pristine-required-message="Campo Requerido"  onkeyup="aMayusculas(this.value,this.id)">
                                @error('medio_pago') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-primary btnModal">Crear Medio de Pago</button>
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
@push('scripts-pagos')
<script src="{{asset('js/medios-pago.js')}}" type="module"></script>
@endpush


@endsection