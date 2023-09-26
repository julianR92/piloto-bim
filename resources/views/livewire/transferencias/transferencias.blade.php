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
                <h1 class="h4">Admin Transferencias</h1>
            </div>   
            <div>
             
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
                            <th data-field="nombres" class="border-0">Cliente</th>                        
                            <th data-field="valor" class="border-0">Valor</th>
                            <th data-field="referencia" class="border-0">Referencia</th>
                            <th data-field="fecha" class="border-0">Fecha de pago</th>
                            <th data-field="verificado" class="border-0">Verificado</th>
                            <th data-field="tipo" class="border-0">Tipo</th>
                            
                            <th class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyColectivo">
                        @foreach($transferencias as $tra)
                         <tr>
                            <td>{{$tra->id}}</td>
                            <td><p>{{$tra->nombres}} {{$tra->nombres}}<br>
                                {{$tra->documento}}</p></td>                        
                                                  
                            <td id="format">{{$tra->valor}}</td>                          
                           <td><p>{{$tra->referencia_pago?$tra->referencia_pago: 'SIN REFERENCIA' }}<br>
                            {{$tra->entidad}}</p></td> 
                           <td>{{$tra->fecha}}</td>                           
                            <td>{{$tra->verificado ? 'Verficado ✔️': 'No Verficado⛔'}}</td>                          
                            <td>@if($tra->tipo =='P')
                                 PROCEDIMIENTO
                                 @else
                                 SERVICIO ADICIONAL
                                 @endif
                            </td>                       
                            <td>
                            @canany(['control-total'])    
                              @if($tra->verificado)                          

                              <button type="button" class="btn btn-danger d-inline-flex align-items-center noVerficarPay verificarPay" data-id="{{$tra->id}}">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="#ebe5e5" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm5 11H7v-2h10v2z"/></svg>No Verificar</button>
                                @else    
                                <button type="button" class="btn btn-success d-inline-flex align-items-center verificarPay text-white" data-id="{{$tra->id}}">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="#ebe5e5" d="m10.6 16.6l7.05-7.05l-1.4-1.4l-5.65 5.65l-2.85-2.85l-1.4 1.4l4.25 4.25ZM12 22q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Z"/></svg>Verificar Pago</button>            
                          
                            @endif
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
       
</div>
</div>
@push('scripts-pagos')
<script src="{{asset('js/validacion-transferencias.js')}}" type="module"></script>
@endpush


@endsection