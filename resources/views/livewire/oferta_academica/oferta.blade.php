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
                <li class="breadcrumb-item"><a href="/oferta-academica">Oferta Académica</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$area->name}}</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">OFERTA ACADÉMICA: {{$area->name}}</h1>
            </div>   
            <div>
                <a type="button" href="{{route('oferta-academica.nuevo',$area->id)}}" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal11" >
                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M12 3a9 9 0 0 0-9 9H0l4 4l4-4H5c0-3.87 3.13-7 7-7s7 3.13 7 7a6.995 6.995 0 0 1-11.06 5.7L6.5 19.14C8.08 20.34 10 21 12 21a9 9 0 0 0 0-18m4.29 10.19l-1-.74c.01-.15.01-.3 0-.45c.02-.15.02-.3 0-.45l1-.74c.08-.07.11-.19.06-.31L15.44 9a.234.234 0 0 0-.29-.12L14 9.3c-.23-.18-.5-.33-.76-.45l-.17-1.18a.214.214 0 0 0-.21-.17H11.1c-.1 0-.21.08-.23.19l-.17 1.19c-.27.12-.53.25-.77.42l-1.12-.45a.23.23 0 0 0-.28.1l-.9 1.55c-.05.11-.03.22.06.29l1 .76c-.03.3-.03.6 0 .9l-1 .74c-.08.07-.11.19-.06.31l.9 1.5c.05.11.17.16.28.12l1.12-.45c.23.18.49.33.76.45l.18 1.18c.02.11.13.2.23.17h1.8c.1 0 .21-.08.22-.19l.18-1.19c.26-.12.51-.26.75-.42l1.13.45c.1 0 .22 0 .28-.12l.9-1.55c.05-.1.02-.22-.07-.29M12 13.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5s1.5.67 1.5 1.5c0 .82-.66 1.5-1.5 1.5"/></svg>Crear Oferta
                </a>
            </div>         
        </div>
    </div>
     
    
    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded" id="myTableOfer" data-toggle="table" data-search="true" data-pagination="true" data-page-size="5" >
                    <thead class="thead-light">
                        <tr>
                            <th data-field="id" data-sortable="true" class="border-0 rounded-start">#</th>
                            <th data-field="programa" class="border-0">Programa</th>
                            @if($area->id==2)
                            <th data-field="colectivo" class="border-0">Colectivo</th>
                            <th data-field="instrumento" class="border-0">Instrumento</th>
                            @endif
                            <th data-field="codigo" class="border-0">Codigo</th>
                            <th data-field="grupo" class="border-0">Grupo y horario</th>
                            <th data-field="etario" class="border-0">Grupo Etario</th>
                            <th data-field="cupos" class="border-0">Cupos</th>
                            <th data-field="estado" class="border-0">Estado</th>
                            <th  data-fied="acciones" class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyEje">
                        @foreach($ofertas as $oferta)
                         <tr>
                            <td>{{$oferta->id}}</td>
                            <td>{{$oferta->programa}}</td>
                            @if($area->id==2)
                            @if($oferta->colectivo)
                            <td>{{$oferta->colectivo}}</td>
                            @else
                            <td>NO APLICA</td>
                            @endif
                            @if($oferta->instrumento)
                            <td>{{$oferta->instrumento}}</td>
                            @else
                            <td>NO APLICA</td>
                            @endif
                            @endif
                            <td>{{$oferta->codigo}}</td>
                            <td>{{$oferta->grupo}}-{{$oferta->horario}}</td>
                            <td>Desde {{$oferta->edad_min}} años Hasta {{$oferta->edad_max}} años</td>
                            <td>{{$oferta->cupos}}</td>
                            <td> {{($oferta->estado)? 'VISIBLE': 'OCULTA'}} </td>
                            <td>
                                <a href="{{route('oferta-academica.edit',$oferta->id)}}">
                                <button type="button" class="btn btn-success d-inline-flex align-items-center editarOferta">
                                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>
                                </a>
                                @canany(['control-total'])
                                <button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarOferta"  data-id="{{$oferta->id}}"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>
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
                    <a href="/oferta-academica" class="text-info me-3 float-end"><svg width="16" height="16" viewBox="0 0 24 24">
                     <path fill="currentColor" d="M3.97 12c0 4.41 3.62 8.03 8.03 8.03c4.41 0 8.03-3.62 8.03-8.03c0-4.41-3.62-8.03-8.03-8.03c-4.41 0-8.03 3.62-8.03 8.03M2 12C2 6.46 6.46 2 12 2s10 4.46 10 10s-4.46 10-10 10S2 17.54 2 12m8.46-1V8L6.5 12l3.96 4v-3h7.04v-2"/></svg>Atras</a></div>
            </div>       
    </div>
</div>
</div>
@push('oferta-academica-js')
<script src="{{asset('js/oferta-delete.js')}}" type="module"></script>
@endpush



@endsection