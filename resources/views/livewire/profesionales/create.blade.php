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
                <li class="breadcrumb-item"><a href="#">Parametrización</a></li>
                <li class="breadcrumb-item"><a href="/profesionales">Profesionales</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$titulo}}</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">{{$titulo}}</h1>
            </div>   
                 
        </div>
    </div>
     
    
    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <h2 class="h5 mb-4">Información del Profesional</h2>
            <form action="#" method="#" id="myFormDoce">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="first_name">Nombres*</label>
                            <input name="nombres" onkeypress="return Letras(event)" type="text" class="form-control border-gray-300" placeholder="Ej: Andres" id="nombres"  autofocus required data-pristine-required-message="Campo Requerido" maxlength="20" @isset($datos) value="{{$datos->nombres}}"@endisset>
                        </div>
                        @error('nombres') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="last_name">Apellidos*</label>
                            <input name="apellidos" onkeypress="return Letras(event)" type="text" class="form-control border-gray-300" placeholder="Ej: Perez" id="apellidos" required data-pristine-required-message="Campo Requerido" maxlength="20"  @isset($datos) value="{{$datos->apellidos}}"@endisset>
                        </div>
                        @error('apellidos') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                        <label for="documento">Documento de identidad*</label>
                        <input name="documento" onkeypress="return NumDoc(event)" type="text" class="form-control border-gray-300" placeholder="Ej: 13678213" id="documento" required data-pristine-required-message="Campo Requerido" maxlength="10"  @isset($datos) value="{{$datos->documento}}"@endisset>
                        </div>
                        @error('documento') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                       
                    </div>
                    <div class="col-md-6 mb-3">  
                        {{-- <div class="form-group">
                            <label for="tipo_doc">Tipo de documento*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="tipo_doc" id="tipo_doc" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido">
                                    <option value="">Seleccione..</option>
                                    <option value="C.C"  @isset($datos) @if($datos->tipo_doc == 'C.C') selected @endif @endisset>Cedula de ciudadania</option>
                                    <option value="P.P" @isset($datos) @if($datos->tipo_doc == 'P.P') selected @endif @endisset>Pasaporte</option>
                                    <option value="NUIP" @isset($datos) @if($datos->tipo_doc == 'NUIP') selected @endif @endisset>NUIP</option>
                                    <option value="C.E" @isset($datos) @if($datos->tipo_doc == 'C.E') selected @endif @endisset>Cedula de extranjería</option>
                                </select>
                                @error('tipo_doc') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>                            --}}
                        <div class="form-group">
                            <label for="direccion">Direccion*</label>
                            <input name="direccion" onkeypress="return Direccion(event)" type="text" class="form-control border-gray-300" placeholder="Ej: Calle 23#12-12" id="direccion" required data-pristine-required-message="Campo Requerido" maxlength="100"  @isset($datos) value="{{$datos->direccion}}"@endisset>
                            </div>
                            @error('direccion') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                    </div>
                </div>
                {{-- <h2 class="h5 my-4">Location</h2> --}}
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="celular">Celular*</label>
                            <input  class="form-control" name="celular" id="celular" type="number"
                                placeholder="Ej: 3168706133" required data-pristine-required-message="Campo Requerido" maxlength="10" minlength="7"  @isset($datos) value="{{$datos->celular}}"@endisset>
                        </div>
                        @error('celular') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="correo">Email*</label>
                            <input  class="form-control" onchange="return Email(event)" name="correo" id="correo" type="mail"
                                placeholder="Ej: richart@example.com" required data-pristine-required-message="Campo Requerido"  @isset($datos) value="{{$datos->correo}}"@endisset>
                        </div>
                        @error('correo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                  
                </div>
                <div class="row">                   
                    <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="cargo">Cargo</label>
                            <input class="form-control" onkeypress="return Letras(event)" name="cargo" id="cargo" type="text" placeholder="Ej: Lider" maxlength="40"  @isset($datos) value="{{$datos->cargo}}"@endisset  required data-pristine-required-message="Campo Requerido" onkeyup="aMayusculas(this.value,this.id)">
                        </div>
                        @error('cargo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div> 
                </div>    
                <div class="row">          
                    <div class="col-md-2 mt-3">
                        <input type="hidden" name="id" @isset($datos) value="{{$datos->id}}"@endisset>
                        <input type="hidden" name="user_id" @isset($datos) value="{{$datos->user_id}}"@endisset>
                        <button type="submit" class="btn btn-gray-800 mt-2 btnSubmit"  @isset($datos) onclick="confirm('Recuerde que si actualiza el correo tambien cambiara el usuario de ingreso a la plataforma ¿Esta seguro?')" @endisset>{{$butttonMessage}}</button>
                    </div>
                    <div class="col-md-1">
                        <x-loader/>
                    </div>    
                    </div>                
            </form>
        </div>
    </div>
    <div class="row">
        <div class="d-flex justify-content-end">
            <a href="/profesionales" class="text-info me-3 float-end"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3.97 12c0 4.41 3.62 8.03 8.03 8.03c4.41 0 8.03-3.62 8.03-8.03c0-4.41-3.62-8.03-8.03-8.03c-4.41 0-8.03 3.62-8.03 8.03M2 12C2 6.46 6.46 2 12 2s10 4.46 10 10s-4.46 10-10 10S2 17.54 2 12m8.46-1V8L6.5 12l3.96 4v-3h7.04v-2"/></svg>Atras</a></div>
        </div>       
    </div>
    {{-- MODAL --}}
    
   </div>
</div>

@push('scripts-profesionales')
<script src="{{asset('js/profesionales.js')}}" type="module"></script>
@endpush



@endsection