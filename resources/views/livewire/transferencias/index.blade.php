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
                <li class="breadcrumb-item active" aria-current="page">Admin Transferencias</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Administración de Transferencias</h1>
            </div>   
            <div>
                {{-- <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="m1.39 18.36l1.77-1.76L4.58 18l1.06-1.05l-1.42-1.41l1.42-1.42l2.47 2.48l1.06-1.06l-2.47-2.48l1.41-1.41l1.42 1.41L10.59 12l-1.42-1.41l1.42-1.42l2.47 2.48l1.06-1.06l-2.47-2.48l1.41-1.41l1.41 1.41l1.07-1.06l-1.42-1.41l1.42-1.42L18 6.7l1.07-1.06l-2.47-2.48l1.76-1.77l4.25 4.25L5.64 22.61l-4.25-4.25Z"/></svg>Crear Tallas
                </a> --}}
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
                            <th data-field="nombres" class="border-0">Nombres</th>
                            <th data-field="documento" class="border-0">Documento</th>
                            <th data-field="valor" class="border-0">Valor</th>
                            <th data-field="referencia" class="border-0">Referencia</th>
                            <th data-field="fecha_pago" class="border-0">Fecha de pago</th>
                            <th data-field="verificado" class="border-0">Verificado</th>
                            <th data-field="fecha" class="border-0">Fecha de creacion</th>
                            
                            <th class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyColectivo">
                        @foreach($transferencias as $tra)
                         <tr>
                            <td>{{$tra->id}}</td>
                            <td>{{$tra->nombres}} {{$tra->nombres}}</td>                          
                            <td>{{$tra->documento}}</td>                          
                            <td id="format">{{$tra->valor}}</td>                          
                           <td>{{$tra->referencia_pago?$tra->referencia_pago: 'SIN REFERENCIA' }}</td> 
                           <td>{{$tra->fecha_pago}}</td>                           
                            <td>{{$tra->verificado ? 'Verficado ✔️': 'No Verficado⛔'}}</td>                          
                            <td>{{$tra->created_at}}</td>                       
                            <td>
                              @if($tra->verificado)                          

                              <button type="button" class="btn btn-danger d-inline-flex align-items-center noVerficarPay verificarPay" data-id="{{$tra->id}}">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="#ebe5e5" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm5 11H7v-2h10v2z"/></svg>No Verificar</button>
                                @else    
                                <button type="button" class="btn btn-success d-inline-flex align-items-center verificarPay text-white" data-id="{{$tra->id}}">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="#ebe5e5" d="m10.6 16.6l7.05-7.05l-1.4-1.4l-5.65 5.65l-2.85-2.85l-1.4 1.4l4.25 4.25ZM12 22q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Z"/></svg>Verificar Pago</button>            
                          
                            @endif
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
                    <h2 class="h4 text-center titulo-modal">Crear Talla</h2>
                    <form action="#" method="" id="myForm">                        
                    
                        <div class="form-group mb-4">
                            <label for="talla">Talla *</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M172 120a44 44 0 1 1-44-44a44 44 0 0 1 44 44Zm60 8A104 104 0 1 1 128 24a104.2 104.2 0 0 1 104 104Zm-16 0a88 88 0 1 0-153.8 58.4a81.3 81.3 0 0 1 24.5-23a59.7 59.7 0 0 0 82.6 0a81.3 81.3 0 0 1 24.5 23A87.6 87.6 0 0 0 216 128Z"/></svg>
                                </span>
                                <input name="talla" type="text" class="form-control border-gray-300" placeholder="Ej: Xs" id="talla" required data-pristine-required-message="Campo Requerido" onkeyup="aMayusculas(this.value,this.id)">
                                @error('talla') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-primary btnModal">Crear Talla</button>
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>    
</div>
</div>
@push('scripts-pagos')
<script src="{{asset('js/transferencias.js')}}" type="module"></script>
@endpush


@endsection