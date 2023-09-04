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
                <li class="breadcrumb-item"><a href="#">Profesionales</a></li>              
                <li class="breadcrumb-item active" aria-current="page">Estilistas</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Administración de Profesionales</h1>
            </div> 
            <div>
                <a type="button" href="{{route('profesional.create')}}" class="btn btn-outline-gray-600 d-inline-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 48 48"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"><path d="m19.193 21.544l2.319 18.552a3.473 3.473 0 0 1-6.892.862l-2.374-18.989"/><path d="M13 4a9 9 0 0 0 0 18c1.578 0 3.74-.175 6.193-.456l12.403-2.022L44 17.5v-9L28.5 6.25L13 4Zm24 4.2v9.6m7-.3l-12.403 2.022M44 8.5L28.5 6.25"/><path d="M16 13a3 3 0 1 1-6 0a3 3 0 0 1 6 0Z"/></g></svg>Crear Profesional
                </a>
            </div>    
                 
        </div>
    </div>
     
    
    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded" id="myTableDoc" data-toggle="table" data-search="true" data-pagination="true" data-page-size="5" >
                    <thead class="thead-light">
                        <tr>
                            <th data-field="id" data-sortable="true" class="border-0 rounded-start">#</th>
                            <th data-field="nombres" class="border-0">Nombres</th>
                            <th data-field="documento" class="border-0">Documento</th>
                            <th data-field="celular" class="border-0">Celular</th>
                            <th data-field="cargo" class="border-0">Cargo</th>
                            <th class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyEje">
                        @foreach($profesional as $pro)
                         <tr>

                            <td>{{$pro->id}}</td>
                            <td>{{$pro->nombres}} {{$pro->apellidos}}</td>                           
                            <td>{{$pro->documento}}</td>                           
                            <td>{{$pro->celular}}</td>
                            <td>{{$pro->cargo}}</td>
                           
                            <td>
                            <a href="{{route('profesional.edit',$pro->id)}}">
                            <button type="button" class="btn btn-success d-inline-flex align-items-center editarDocente">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>
                            </a>                         
                            <button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarDocente"  data-id="{{$pro->id}}"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>
                          
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
        </div>       
    </div>
    {{-- MODAL --}}
    
   </div>
</div>
@push('scripts-profesionales')
<script src="{{asset('js/profesionales-delete.js')}}" type="module"></script>
@endpush



@endsection