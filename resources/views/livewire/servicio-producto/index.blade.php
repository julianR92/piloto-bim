@extends('layouts.main')

@section('content')
@php setlocale(LC_MONETARY, 'es_CO'); @endphp
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
                <li class="breadcrumb-item"><a href="#">Parametrizacion</a></li>
                <li class="breadcrumb-item active" aria-current="page">Productos x Servicio</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Administración de Productos x Servicio</h1>
            </div>   
            <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M7.572 3.062c-.582.687-.702 1.692-.944 3.704l-.09.757c-.251 2.088-.376 3.132.22 3.804c.597.673 1.648.673 3.75.673h.742v1.75H7c-.321 0-.622.086-.88.237l-.28-.837a4.692 4.692 0 0 0-.205-.543a3.078 3.078 0 0 0-.198-.371c-.285-.469-.656-.876-1.258-1.14c-.566-.25-1.274-.346-2.179-.346a.75.75 0 0 0 0 1.5c.827 0 1.29.092 1.574.218c.249.11.41.265.581.547c.03.05.043.071.056.096c.013.024.031.058.063.127c.05.11.075.18.15.404l.864 2.595a.748.748 0 0 0 .147.256A2.751 2.751 0 0 0 8 18.25h3.25v1.166a3.63 3.63 0 0 0-2.462 2.347a.75.75 0 0 0 1.423.474a2.13 2.13 0 0 1 1.039-1.216V22a.75.75 0 0 0 1.5 0v-.98a2.13 2.13 0 0 1 1.039 1.217a.75.75 0 0 0 1.422-.474a3.63 3.63 0 0 0-2.461-2.347V18.25H16a2.751 2.751 0 0 0 2.565-1.757a.747.747 0 0 0 .146-.256l.866-2.595c.074-.224.098-.295.15-.404a2.24 2.24 0 0 1 .118-.223c.172-.282.332-.437.581-.547c.285-.126.747-.218 1.574-.218a.75.75 0 0 0 0-1.5c-.905 0-1.613.095-2.18.345c-.6.265-.972.672-1.257 1.14a3.078 3.078 0 0 0-.198.372a4.685 4.685 0 0 0-.206.543l-.279.837a1.742 1.742 0 0 0-.88-.237h-4.25V12h.741c2.103 0 3.154 0 3.75-.673c.598-.672.472-1.716.222-3.804l-.091-.757c-.241-2.012-.362-3.017-.944-3.704a3 3 0 0 0-.638-.566C15.04 2 14.026 2 12 2s-3.039 0-3.79.496a3 3 0 0 0-.638.566Z"/></svg>Crear Producto x Servicio
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
                            <th data-field="servicio" class="border-0">Nombre Servicio</th>
                            <th data-field="nombre" class="border-0">Producto</th>
                            <th data-field="cantidad" class="border-0">Cantidad</th>                          
                           <th class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyColectivo">
                        @foreach($servicios_productos as $servi_prod)
                         <tr>
                            <td>{{$servi_prod->id}}</td>
                            <td>{{$servi_prod->servicio}}</td>
                            <td>{{$servi_prod->nombre}}</td>                            
                            <td id="format">{{$servi_prod->cantidad}}</td>
                            <td>
                            <button type="button" class="btn btn-success d-inline-flex align-items-center editarData" data-id="{{$servi_prod->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>
                                @canany(['control-total'])
                            <button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarData" data-id="{{$servi_prod->id}}">
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
                    <h2 class="h4 text-center titulo-modal">Crear Producto x Servicio</h2>
                    <form action="#" method="" id="myForm">
                        
                      
                           <div class="form-group mb-2">
                            <label for="servicio_id">Servicio*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="servicio_id" id="servicio_id" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido" >
                                    <option value="">Seleccione..</option>
                                    @foreach($servicios as $servicio)
                                    <option value={{$servicio->id}}>{{ $servicio->servicio}}</option>
                                @endforeach
                                </select>
                                @error('servicio_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                           <div class="form-group mb-2">
                            <label for="producto_id">Producto*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="producto_id" id="producto_id" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido" >
                                    <option value="">Seleccione..</option>
                                    @foreach($productos as $producto)
                                    <option value={{$producto->id}}>{{ $producto->nombre}}</option>
                                @endforeach
                                </select>
                                @error('producto_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>                        
                        
                        <div class="form-group mb-4">
                            <label for="cantidad">Cantidad <small>(tentativa en gramos) *</small></label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="m20.5 10l.5-2h-4l1-4h-2l-1 4h-4l1-4h-2L9 8H5l-.5 2h4l-1 4h-4L3 16h4l-1 4h2l1-4h4l-1 4h2l1-4h4l.5-2h-4l1-4h4zm-7 4h-4l1-4h4l-1 4z"/></svg>
                                </span>
                                <input name="cantidad" type="text" class="form-control border-gray-300" placeholder="Ej: 10" id="cantidad" required data-pristine-required-message="Campo Requerido" onkeypress="return Numeros(event)" data-pristine-type="integer">
                                @error('cantidad') <div class="invalid-feedback" > {{ $message }} </div> @enderror 
                            </div> 
                        </div>                         
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-primary btnModal">Crear Precio</button>
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>    
</div>
</div>
@push('scripts-parametrizacion')
<script src="{{asset('js/servicios-productos.js')}}" type="module"></script>
@endpush


@endsection