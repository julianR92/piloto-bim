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
                <li class="breadcrumb-item active" aria-current="page">Cuentas de Pago</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Administración de cuentas de Pago</h1>
            </div>   
            <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="#16b10b" fill-rule="evenodd" d="M12.052 1.25h-.104c-.899 0-1.648 0-2.242.08c-.628.084-1.195.27-1.65.725c-.456.456-.642 1.023-.726 1.65c-.057.427-.074 1.446-.078 2.32c-2.022.067-3.237.303-4.08 1.147C2 8.343 2 10.229 2 14c0 3.771 0 5.657 1.172 6.828C4.343 22 6.229 22 10 22h4c3.771 0 5.657 0 6.828-1.172C22 19.657 22 17.771 22 14c0-3.771 0-5.657-1.172-6.828c-.843-.844-2.058-1.08-4.08-1.146c-.004-.875-.02-1.894-.078-2.32c-.084-.628-.27-1.195-.726-1.65c-.455-.456-1.022-.642-1.65-.726c-.594-.08-1.344-.08-2.242-.08Zm3.196 4.752c-.005-.847-.019-1.758-.064-2.097c-.063-.461-.17-.659-.3-.789c-.13-.13-.328-.237-.79-.3c-.482-.064-1.13-.066-2.094-.066s-1.612.002-2.095.067c-.461.062-.659.169-.789.3c-.13.13-.237.327-.3.788c-.045.34-.06 1.25-.064 2.097C9.143 6 9.56 6 10 6h4c.441 0 .857 0 1.248.002ZM12 9.25a.75.75 0 0 1 .75.75v.01c1.089.274 2 1.133 2 2.323a.75.75 0 0 1-1.5 0c0-.384-.426-.916-1.25-.916c-.824 0-1.25.532-1.25.916s.426.917 1.25.917c1.385 0 2.75.96 2.75 2.417c0 1.19-.911 2.048-2 2.323V18a.75.75 0 0 1-1.5 0v-.01c-1.089-.274-2-1.133-2-2.323a.75.75 0 0 1 1.5 0c0 .384.426.916 1.25.916c.824 0 1.25-.532 1.25-.916s-.426-.917-1.25-.917c-1.385 0-2.75-.96-2.75-2.417c0-1.19.911-2.049 2-2.323V10a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd"/></svg>Crear cuenta de pago
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
                            <th data-field="medio_pago" class="border-0">Medio de Pago</th>
                            <th data-field="entidad" class="border-0">Entidad</th>
                            <th data-field="numero_cuenta" class="border-0">N° Cuenta</th>
                            <th data-field="estado" class="border-0">Estado</th>
                            <th class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyColectivo">
                        @foreach($cuentas as $cuenta)
                         <tr>
                            <td>{{$cuenta->id}}</td>
                            <td>{{$cuenta->medio_pago}}</td>
                            <td>{{$cuenta->entidad}}</td>
                            <td>{{$cuenta->numero_cuenta}}</td>
                            <td>{{($cuenta->estado)? 'ACTIVO✔️': 'INACTIVO❌'}}</td>
                            <td>
                            <button type="button" class="btn btn-success d-inline-flex align-items-center editarData" data-id="{{$cuenta->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>
                               <button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarData" data-id="{{$cuenta->id}}">
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
                    <h2 class="h4 text-center titulo-modal">Crear Tipo servicio</h2>
                    <form action="#" method="" id="myForm">
                        
                        <div class="form-group mb-2">
                            <label for="medio_pago_id">Medio de Pago*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="medio_pago_id" id="medio_pago_id" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido" autofocus>
                                    <option value="">Seleccione..</option>
                                    @foreach($medio_pago as $medio)
                                        <option value={{$medio->id}}>{{ $medio->medio_pago }}</option>
                                    @endforeach
                                </select>
                                @error('medio_pago_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-2">
                            <label for="entidad">Entidad *</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M172 120a44 44 0 1 1-44-44a44 44 0 0 1 44 44Zm60 8A104 104 0 1 1 128 24a104.2 104.2 0 0 1 104 104Zm-16 0a88 88 0 1 0-153.8 58.4a81.3 81.3 0 0 1 24.5-23a59.7 59.7 0 0 0 82.6 0a81.3 81.3 0 0 1 24.5 23A87.6 87.6 0 0 0 216 128Z"/></svg>
                                </span>
                                <input name="entidad" type="text" class="form-control border-gray-300" placeholder="Ej: NEQUI" id="entidad" required data-pristine-required-message="Campo Requerido"  onkeyup="aMayusculas(this.value,this.id)" onkeypress="return Letras(event)">
                                @error('entidad') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                        <div class="form-group mb-2">
                            <label for="numero_cuenta">N° de cuenta *</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M172 120a44 44 0 1 1-44-44a44 44 0 0 1 44 44Zm60 8A104 104 0 1 1 128 24a104.2 104.2 0 0 1 104 104Zm-16 0a88 88 0 1 0-153.8 58.4a81.3 81.3 0 0 1 24.5-23a59.7 59.7 0 0 0 82.6 0a81.3 81.3 0 0 1 24.5 23A87.6 87.6 0 0 0 216 128Z"/></svg>
                                </span>
                                <input name="numero_cuenta" type="text" class="form-control border-gray-300" placeholder="Ej: 910132122" id="numero_cuenta" required data-pristine-required-message="Campo Requerido" onkeypress="return Numeros(event)">
                                @error('numero_cuenta') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div> 

                        <div class="form-group mb-4">
                            <label for="estado">Estado*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="estado" id="estado" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido" >
                                    <option value="">Seleccione..</option>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                   
                                </select>
                                @error('estado') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-primary btnModal">Crear Tipo de Servicio</button>
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>    
</div>
</div>
@push('scripts-pagos')
<script src="{{asset('js/cuentas-pagos.js')}}" type="module"></script>
@endpush


@endsection