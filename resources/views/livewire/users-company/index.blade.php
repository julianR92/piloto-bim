@extends('layouts.main')

@section('content')


<div>
    <div class="px-4">
        {{-- @livewire('loader') --}}
    <div class="py-4 px-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#">Modulo Administracion</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mis Usuarios</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Administración de Usuarios {{$empresa->razon_social}}</h1>
            </div>  
            <div>
                <a type="button" href="" class="mt-4 btn btn-outline-info d-inline-flex align-items-center btn-modal" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M13 8c0-2.21-1.79-4-4-4S5 5.79 5 8s1.79 4 4 4s4-1.79 4-4zm2 2v2h3v3h2v-3h3v-2h-3V7h-2v3h-3zM1 18v2h16v-2c0-2.66-5.33-4-8-4s-8 1.34-8 4z"/></svg>Crear Usuario
                </a>
            </div> 
                 
        </div>
    </div>
     
    
    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded" id="myTable" data-toggle="table" data-search="true" data-pagination="true" data-page-size="15">
                    <thead class="thead-light">
                        <tr>
                            <th data-field="id" data-sortable="true" class="border-0 text-center rounded-start">#</th>
                            <th data-field="nombre" class="border-0 text-center">Nombre Usuario</th>
                            <th data-field="email" class="border-0 text-center">Email</th>                            
                            <th data-field="number" class="border-0 text-center">Telefono</th>                            
                            <th data-field="rol" class="border-0 text-center">Rol</th>                            
                            <th data-field="estado" class="border-0 text-center">Estado</th>                            
                            <th class="border-0 text-center">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyColectivo">
                        @foreach($usuarios as $users)
                         <tr>
                            <td>{{$users->id}}</td>
                            <td>{{$users->first_name}} {{$users->last_name}}</td>                          
                            <td>{{$users->email }}</td>                          
                            <td>{{$users->number }}</td>                                                 
                            <td>{{$users->roles[0]['name'] }}</td>                         
                            <td>  
                                @if($users->estado == 'ACTIVO')  
                                <button type="button" class="btn btn-success d-inline-flex align-items-center btn-sm btnActivo" title="activo" data-id="{{$users->id}}">
                                    <svg  class="btnActivo" data-id="{{$users->id}}" width="16" height="16" viewBox="0 0 24 24">
                                        <path  class="btnActivo" data-id="{{$users->id}}"  fill="currentColor"
                                        d="M20 12a8 8 0 0 0-8-8a8 8 0 0 0-8 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8m2 0a10 10 0 0 1-10 10A10 10 0 0 1 2 12A10 10 0 0 1 12 2a10 10 0 0 1 10 10M10 9.5c0 .8-.7 1.5-1.5 1.5S7 10.3 7 9.5S7.7 8 8.5 8s1.5.7 1.5 1.5m7 0c0 .8-.7 1.5-1.5 1.5S14 10.3 14 9.5S14.7 8 15.5 8s1.5.7 1.5 1.5m-5 7.73c-1.75 0-3.29-.73-4.19-1.81L9.23 14c.45.72 1.52 1.23 2.77 1.23s2.32-.51 2.77-1.23l1.42 1.42c-.9 1.08-2.44 1.81-4.19 1.81Z" />
                                    </svg>
                                </button>                                
                                @else
                                <button type="button"  class="btn btn-danger d-inline-flex align-items-center btn-sm btnInactivo"  data-id={{$users->id}} title="inactivo">
                                    <svg class="btnInactivo" data-id="{{$users->id}}"  width="16" height="16" viewBox="0 0 24 24">
                                        <path class="btnInactivo" data-id="{{$users->id}}"  fill="currentColor"
                                            d="M20 12a8 8 0 0 0-8-8a8 8 0 0 0-8 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8m2 0a10 10 0 0 1-10 10A10 10 0 0 1 2 12A10 10 0 0 1 12 2a10 10 0 0 1 10 10m-6.5-4c.8 0 1.5.7 1.5 1.5s-.7 1.5-1.5 1.5s-1.5-.7-1.5-1.5s.7-1.5 1.5-1.5M10 9.5c0 .8-.7 1.5-1.5 1.5S7 10.3 7 9.5S7.7 8 8.5 8s1.5.7 1.5 1.5m2 4.5c1.75 0 3.29.72 4.19 1.81l-1.42 1.42C14.32 16.5 13.25 16 12 16s-2.32.5-2.77 1.23l-1.42-1.42C8.71 14.72 10.25 14 12 14Z" />
                                    </svg>                    
                                </button>                              
                                @endif
                                                        
                              
                            </td>
                            <td>
                                <button type="button" class="btn btn-success d-inline-flex align-items-center editarData btn-sm" data-id="{{$users->id}}">
                                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>                           
                                <button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarData btn-sm" data-id="{{$users->id}}">
                                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>
                                <button type="button" class="btn btn-info d-inline-flex align-items-center resetPassword btn-sm" data-id="{{$users->id}}">
                                    <svg  class="resetPassword" data-id="{{$users->id}}" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M16.71 5.29L19 3h-8v8l2.3-2.3c1.97 1.46 3.25 3.78 3.25 6.42c0 1.31-.32 2.54-.88 3.63c2.33-1.52 3.88-4.14 3.88-7.13c0-2.52-1.11-4.77-2.84-6.33z"/><path fill="currentColor" d="M7.46 8.88c0-1.31.32-2.54.88-3.63a8.479 8.479 0 0 0-3.88 7.13c0 2.52 1.1 4.77 2.84 6.33L5 21h8v-8l-2.3 2.3c-1.96-1.46-3.24-3.78-3.24-6.42z"/></svg>Reset Password</button>
                         
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
                    <div class="d-flex justify-content-center align-items-center mb-5 divLoader d-none">
                    @livewire('loader-dos')
                   </div>
                    <h2 class="h4 text-center titulo-modal">Crear Usuario</h2>
                    <form action="#" method="" id="myForm">                        
                    
                        <div class="form-group mb-2">
                            <label for="permiso">Nombres*</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M172 120a44 44 0 1 1-44-44a44 44 0 0 1 44 44Zm60 8A104 104 0 1 1 128 24a104.2 104.2 0 0 1 104 104Zm-16 0a88 88 0 1 0-153.8 58.4a81.3 81.3 0 0 1 24.5-23a59.7 59.7 0 0 0 82.6 0a81.3 81.3 0 0 1 24.5 23A87.6 87.6 0 0 0 216 128Z"/></svg>
                                </span>
                                <input  data-pristine-required-message="Campo Requerido" onkeypress="return Letras(event)" name="first_name" type="text" class="form-control border-gray-300" placeholder="Ej: Carlos" id="first_name" autofocus required maxlength="20" onkeyup="aMayusculas(this.value,this.id)">
                                @error('first_name') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div> 

                        <div class="form-group mb-2">
                            <label for="permiso">Apellidos*</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M172 120a44 44 0 1 1-44-44a44 44 0 0 1 44 44Zm60 8A104 104 0 1 1 128 24a104.2 104.2 0 0 1 104 104Zm-16 0a88 88 0 1 0-153.8 58.4a81.3 81.3 0 0 1 24.5-23a59.7 59.7 0 0 0 82.6 0a81.3 81.3 0 0 1 24.5 23A87.6 87.6 0 0 0 216 128Z"/></svg>
                                </span>
                                <input data-pristine-required-message="Campo Requerido" onkeypress="return Letras(event)"  name="last_name" type="text" class="form-control border-gray-300" placeholder="Ej: Ardila" id="last_name"  required maxlength="20" onkeyup="aMayusculas(this.value,this.id)">
                                @error('last_name') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                        <div class="form-group mb-2">
                            <label for="permiso">Correo Electronico/Usuario*</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5l-8-5V6l8 5l8-5v2z"/></svg>
                                </span>
                                <input data-pristine-required-message="Campo Requerido"  name="email" type="email" class="form-control border-gray-300" placeholder="Ej: carlos.ardila@gmail.com" id="email" required maxlength="50">
                                @error('email') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                        <div class="form-group mb-2">
                            <label for="permiso">Telefono*</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24c1.12.37 2.33.57 3.57.57c.55 0 1 .45 1 1V20c0 .55-.45 1-1 1c-9.39 0-17-7.61-17-17c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1c0 1.25.2 2.45.57 3.57c.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                                </span>
                                <input  name="number" id="number" type="text" class="form-control border-gray-300" placeholder="Ej: 3168706182" id="email" required data-pristine-required-message="Campo Requerido" onkeypress="return Numeros(event)" maxlength="10" >
                                @error('number') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                        
                        <div class="form-group mb-4">
                            <label for="permiso">Rol*</label>
                            
                            <div class="input-group">   
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="m20 17.17l-3.37-3.38c.64.22 1.23.48 1.77.76c.97.51 1.58 1.52 1.6 2.62zm1.19 4.02l-1.41 1.41l-2.61-2.6H4v-2.78c0-1.12.61-2.15 1.61-2.66c1.29-.66 2.87-1.22 4.67-1.45L1.39 4.22L2.8 2.81l18.39 18.38zM15.17 18l-3-3H12c-2.37 0-4.29.73-5.48 1.34c-.32.16-.52.5-.52.88V18h9.17zM12 6c1.1 0 2 .9 2 2c0 .86-.54 1.59-1.3 1.87l1.48 1.48a3.999 3.999 0 1 0-5.53-5.53l1.48 1.48A1.99 1.99 0 0 1 12 6z"/></svg>
                                </span>                             
                                <select name="role_id" id="role_id" class="border-gray-300 form-select" data-pristine-required-message="Campo Requerido" required>
                                    <option value="">Seleccione..</option>
                                    @foreach($roles as $rol)
                                    <option value={{$rol->id}}>{{ $rol->name }}</option>
                                  @endforeach
                                </select>
                                @error('role_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                        </div> 
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="empresa_id" id="empresa_id" value="{{$empresa->id}}">
                            <button type="submit" class="btn btn-info btnModal">Crear Usuario</button>
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>    
</div>
</div>
@push('scripts-users-company')
<script src="{{asset('js/users-company.js')}}" type="module"></script>
@endpush


@endsection