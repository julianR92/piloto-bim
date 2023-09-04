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
                <li class="breadcrumb-item"><a href="#">Configuracion</a></li>
                <li class="breadcrumb-item active" aria-current="page">Programas</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Programas</h1>
            </div>   
            <div>
                {{-- <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal6" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3.5 19L2 17.5L9.5 10l4 4l1.675-1.9l-5.6-5.175L3.5 13L2 11.5L9.5 4l7.1 6.525L20.6 6L22 7.4l-3.95 4.45L22 15.5L20.5 17l-3.85-3.55L13.5 17l-4-4Z"/></svg>Crear Eje --}}
                </a>
            </div>         
        </div>
    </div>
    <div class="row">
       @foreach($areas as $area)    
        
        <div class="col-12 col-sm-6 col-xl-6 mb-4">
            <a href="/programas/{{$area->id}}">
              <div class="cards">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                                    <img src="/assets/img/imct/{{$area->ruta_image}}">
                                </div>
                                <div class="d-sm-none">
                                    <h2 class="h5">Area</h2>
                                    <h3 class="fw-extrabold mb-1">{{$area->name}}</h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h6 text-gray-400 mb-0">Area</h2>
                                    <h3 class="fw-extrabold mb-2">{{$area->name}}</h3>
                                </div>
                             
                             
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </a>
        </div>
   @endforeach
    </div>

    
    {{-- MODAL --}}
    {{-- <div class="modal fade" id="modalSignIn" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar6" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo">Crear Eje</h2>
                    <p class="text-center mb-4">Los ejes se asocian a los procesos para crear la oferta</p>
                    <form action="#" method="POST" id="myEjeForm">
                         
                        
                        <div class="form-group mb-4">
                            <label for="permiso">Nombre Eje*</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M172 120a44 44 0 1 1-44-44a44 44 0 0 1 44 44Zm60 8A104 104 0 1 1 128 24a104.2 104.2 0 0 1 104 104Zm-16 0a88 88 0 1 0-153.8 58.4a81.3 81.3 0 0 1 24.5-23a59.7 59.7 0 0 0 82.6 0a81.3 81.3 0 0 1 24.5 23A87.6 87.6 0 0 0 216 128Z"/></svg>
                                </span>
                                <input name="descripcion" type="text" class="form-control border-gray-300" placeholder="Ej: Tecnico Laboral" id="descripcion" autofocus required data-pristine-required-message="Campo Requerido">
                                @error('descripcion') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                        
                        <div class="form-group mb-4">
                            <label for="permiso">Proceso*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="proceso" id="proceso" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido">
                                    <option value="">Seleccione..</option>
                                    @foreach($procesos as $proceso)
                                        <option value={{$proceso->id}}>{{ $proceso->name }}</option>
                                    @endforeach
                                </select>
                                @error('proceso') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="id" id="idEje">
                            <button type="submit" class="btn btn-primary btnModal">Crear Eje</button>
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div> --}}
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



@endsection