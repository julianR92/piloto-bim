@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="/css/buttons.css">
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
                <li class="breadcrumb-item"><a href="#">Admin Clientes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear Cliente</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Administración de clientes</h1>
            </div>   
            <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal-docPru" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg width="16" height="16" viewBox="0 0 20 20"><path fill="currentColor" d="M6.75 9a3.25 3.25 0 1 0 0-6.5a3.25 3.25 0 0 0 0 6.5ZM17 6.5a2.5 2.5 0 1 1-5 0a2.5 2.5 0 0 1 5 0Zm-8 8c0-1.704.775-3.228 1.993-4.237A1.991 1.991 0 0 0 10 10H3.5a2 2 0 0 0-2 2s0 4 5.25 4c.953 0 1.733-.132 2.371-.347A5.522 5.522 0 0 1 9 14.5Zm10 0a4.5 4.5 0 1 1-9 0a4.5 4.5 0 0 1 9 0Zm-2.146-1.854a.5.5 0 0 0-.708 0L13.5 15.293l-.646-.647a.5.5 0 0 0-.708.708l1 1a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0 0-.708Z"/></svg>Agregar Cliente
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
                            <th data-field="nombres" class="border-0">Nombres</th>
                            <th data-field="telefono" class="border-0">Telefono -WP</th>
                            <th data-field="instagram" class="border-0">Instagram</th>
                            <th data-field="estado" class="border-0">Estado</th>
                            <th class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyColectivo">
                        @foreach($clientes as $cliente)
                         <tr>
                            <td>{{$cliente->id}}</td>
                            <td>{{$cliente->nombres}} {{$cliente->apellidos}}</td>
                            <td>{{$cliente->telefono}}-{{$cliente->whatsapp}}</td>
                            <td>{{$cliente->instagram}}</td>
                            <td>@if($cliente->estado)
                                <button class="button-activo btnEstado" data-id="{{$cliente->id}}">Activo</button>
                                @else
                                <button class="button-inactivo btnEstado" data-id="{{$cliente->id}}">Inactivo</button>                            
                            @endif
                            </td>
                            <td>
                            <button type="button" class="btn btn-success btn-sm d-inline-flex align-items-center editarData" data-id="{{$cliente->id}}" title="editar cliente"><svg class="editarData" data-id="{{$cliente->id}}" width="16" height="16" viewBox="0 0 24 24"><path lass="editarData" data-id="{{$cliente->id}}" fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg></button>    
                            @canany(['control-total'])                           
                            <button type="button" class="btn btn-danger btn-sm d-inline-flex align-items-center eliminarData" data-id="{{$cliente->id}}" title="eliminar cliente"><svg width="16" height="16" class="eliminarData" data-id="{{$cliente->id}}" viewBox="0 0 24 24"><path  class="eliminarData" data-id="{{$cliente->id}}" fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg></button>
                            @endcanany
                            <button type="button" class="btn btn-info btn-sm d-inline-flex align-items-center addAbono" data-nombre="{{$cliente->nombres}} {{$cliente->apellidos}}" data-id="{{$cliente->id}}" title="Agregar Abono"><svg class="addAbono"  data-nombre="{{$cliente->nombres}} {{$cliente->apellidos}}" data-id="{{$cliente->id}}"  xmlns="http://www.w3.org/2000/svg" width="16"  height="16" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><path class="addAbono" data-id="{{$cliente->id}}"  data-nombre="{{$cliente->nombres}} {{$cliente->apellidos}}" d="M17.414 10.414C18 9.828 18 8.886 18 7c0-1.886 0-2.828-.586-3.414m0 6.828C16.828 11 15.886 11 14 11h-4c-1.886 0-2.828 0-3.414-.586m10.828 0Zm0-6.828C16.828 3 15.886 3 14 3h-4c-1.886 0-2.828 0-3.414.586m10.828 0Zm-10.828 0C6 4.172 6 5.114 6 7c0 1.886 0 2.828.586 3.414m0-6.828Zm0 6.828ZM13 7a1 1 0 1 1-2 0a1 1 0 0 1 2 0Z"/><path  data-nombre="{{$cliente->nombres}} {{$cliente->apellidos}}" class="addAbono" data-id="{{$cliente->id}}" stroke-linecap="round" d="M18 6a3 3 0 0 1-3-3m3 5a3 3 0 0 0-3 3M6 6a3 3 0 0 0 3-3M6 8a3 3 0 0 1 3 3m-4 9.388h2.26c1.01 0 2.033.106 3.016.308a14.85 14.85 0 0 0 5.33.118c.868-.14 1.72-.355 2.492-.727c.696-.337 1.549-.81 2.122-1.341c.572-.53 1.168-1.397 1.59-2.075c.364-.582.188-1.295-.386-1.728a1.887 1.887 0 0 0-2.22 0l-1.807 1.365c-.7.53-1.465 1.017-2.376 1.162c-.11.017-.225.033-.345.047m0 0a8.176 8.176 0 0 1-.11.012m.11-.012a.998.998 0 0 0 .427-.24a1.492 1.492 0 0 0 .126-2.134a1.9 1.9 0 0 0-.45-.367c-2.797-1.669-7.15-.398-9.779 1.467m9.676 1.274a.524.524 0 0 1-.11.012m0 0a9.274 9.274 0 0 1-1.814.004"/><rect class="addAbono"  data-nombre="{{$cliente->nombres}} {{$cliente->apellidos}}" data-id="{{$cliente->id}}" width="3" height="8" x="2" y="14" rx="1.5"/></g></svg></button>
                            <button type="button" class="btn btn-gray-200 btn-sm d-inline-flex align-items-center viewAbonos" data-nombre="{{$cliente->nombres}} {{$cliente->apellidos}}" data-id="{{$cliente->id}}" title="Ver Abono"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="viewAbonos"  data-nombre="{{$cliente->nombres}} {{$cliente->apellidos}}" data-id="{{$cliente->id}}"><g fill="none" fill-rule="evenodd"><path class="viewAbonos"  data-nombre="{{$cliente->nombres}} {{$cliente->apellidos}}" data-id="{{$cliente->id}}" d="M24 0v24H0V0h24ZM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018Zm.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01l-.184-.092Z" /><path class="viewAbonos"   data-nombre="{{$cliente->nombres}} {{$cliente->apellidos}}" data-id="{{$cliente->id}}" fill="#ff99ca" d="M11.5 3a4.502 4.502 0 0 1 4.336 3.292l.052.205l1.87-.467a1 1 0 0 1 1.233.84L19 7v1.81a6.517 6.517 0 0 1 1.364 1.882l.138.308H21a1 1 0 0 1 .993.883L22 12v3a1 1 0 0 1-.445.832l-.108.062l-1.168.585a6.525 6.525 0 0 1-2.02 2.325l-.259.174V20a1 1 0 0 1-.883.993L17 21h-3a1 1 0 0 1-.993-.883L13 20h-1a1 1 0 0 1-.883.993L11 21H8a1 1 0 0 1-.993-.883L7 20v-1.022a6.508 6.508 0 0 1-2.854-4.101a3.002 3.002 0 0 1-2.14-2.693L2 12v-.5a1 1 0 0 1 1.993-.117L4 11.5v.5c0 .148.032.289.09.415a6.504 6.504 0 0 1 2.938-4.411A4.5 4.5 0 0 1 11.5 3Zm4.5 8a1 1 0 1 0 0 2a1 1 0 0 0 0-2Zm-4.5-6a2.5 2.5 0 0 0-2.478 2.169A6.52 6.52 0 0 1 10.5 7h3.377l.07-.017A2.5 2.5 0 0 0 11.5 5Z"/></g></svg></button>
                                
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
                    <h2 class="h4 text-center titulo-modal">Crear Cliente</h2>
                    <form action="#" method="" id="myForm">
                        
                        <div class="form-group mb-2">
                            <label for="nombres">Nombres*</label>
                            <div>
                            <div class="input-group">                                
                                <input name="nombres" type="text" class="form-control border-gray-300" placeholder="Ej: Andrea" id="nombres" required data-pristine-required-message="Campo Requerido" onkeyup="aMayusculas(this.value,this.id)" onkeypress="return Letras(event)">
                                @error('nombres') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="apellidos">Apellidos*</label>
                            <div>
                            <div class="input-group">                                
                                <input name="apellidos" type="text" class="form-control border-gray-300" placeholder="Ej: Muñoz" id="apellidos" required data-pristine-required-message="Campo Requerido" onkeyup="aMayusculas(this.value,this.id)" onkeypress="return Letras(event)">
                                @error('apellidos') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        <div class="row">                            
                        <div class="form-group mb-2 col-md-6">
                            <label for="documento">Documento*</label>
                            <div>
                            <div class="input-group">                                
                                <input name="documento" type="text" class="form-control border-gray-300" placeholder="Ej: 91078541" id="documento" required data-pristine-required-message="Campo Requerido" data-pristine-type="integer" maxlength="15" onkeypress="return Numeros(event)">
                                @error('documento') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        <div class="form-group mb-2 col-md-6">
                            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                            <div>
                            <div class="input-group">                                
                                <input name="fecha_nacimiento" type="date" class="form-control border-gray-300" max="@php echo date('Y-m-d') @endphp" id="fecha_nacimiento">
                                @error('fecha_nacimiento') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        </div>
                       <div class="row">
                        <div class="form-group mb-2 col-md-6">
                            <label for="telefono">Telefono*</label>
                            <div>
                            <div class="input-group">                                
                                <input name="telefono" type="text" class="form-control border-gray-300" placeholder="Ej: 3168791231" id="telefono" required data-pristine-required-message="Campo Requerido" data-pristine-type="integer" maxlength="10" onkeypress="return Numeros(event)">
                                @error('telefono') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        <div class="form-group mb-2 col-md-6">
                            <label for="whatsapp">Whatsapp</label>
                            <div>
                            <div class="input-group">                                
                                <input name="whatsapp" type="text" class="form-control border-gray-300" placeholder="Ej: 3123123123" id="whatsapp" data-pristine-required-message="Campo Requerido" data-pristine-type="integer" maxlength="10" onkeypress="return Numeros(event)">
                                @error('whatsapp') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                       </div>
                       <div class="row">
                        <div class="form-group mb-3 col-md-4">
                            <label for="instagram">instagram</label>
                            <div>
                            <div class="input-group">                                
                                <input name="instagram" type="text" class="form-control border-gray-300" placeholder="Ej: @julian9230" id="instagram" maxlength="15" >
                                @error('instagram') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        <div class="form-group mb-3 col-md-8">
                            <label for="observacion">Observaciones</label>
                            <div>
                            <div class="input-group">                                
                                <textarea  class="form-control border-gray-300" name="observacion" id="observacion" style="resize: none;" onkeypress="return Letras(event)" maxlength="200"></textarea>
                                @error('observacion') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                       </div> 
                       <div class="row">
                        <div class="form-group mb-2 col-md-12">
                            <label for="direccion">Direccion</label>
                            <div>
                            <div class="input-group">                                
                                <input name="direccion" type="text" class="form-control border-gray-300" placeholder="Ej: Cra 28 # 19 - 19" id="direccion" onkeyup="aMayusculas(this.value,this.id)" onkeypress="return Direccion(event)">
                                @error('direccion') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        </div> 
                       <div class="row">
                        <div class="form-group mb-3 col-md-12">
                            <label for="calificacion_id">Calificacion*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="calificacion_id" id="calificacion_id" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido" required data-pristine-required-message="Campo Requerido">                                   
                                    @foreach($calificaciones as $calificacion)
                                        <option value={{$calificacion->id}}>{{ $calificacion->calificacion }}</option>
                                    @endforeach
                                </select>
                                @error('calificacion_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                            </div>
                        </div>
                        
                    </div>                     
                         
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-primary btnModal">Crear Cliente</button>
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>    
    {{-- MODAL abono --}}
    <div class="modal fade" id="modalAbono" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar-abono" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo-modal-abono">Agregar Abono</h2>
                    <form action="#" method="" id="myFormModal">
                        
                        <div class="form-group mb-2">
                            <label for="nombre_abono">Nombre cliente*</label>
                            <div>
                            <div class="input-group">                                
                                <input name="nombre_abono" type="text" class="form-control border-gray-300" placeholder="Ej: Andrea" id="nombre_abono" required data-pristine-required-message="Campo Requerido" onkeyup="aMayusculas(this.value,this.id)" onkeypress="return Letras(event)" readonly>
                                @error('nombre_abono') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>                       
                       
                       <div class="row">
                        <div class="form-group mb-2 col-md-4">
                            <label for="valor">Valor*</label>
                            <div>
                            <div class="input-group">                                
                                <input name="valor" type="text" class="form-control border-gray-300" placeholder="Ej: 40000" id="valor" data-pristine-required-message="Campo Requerido" data-pristine-type="integer" maxlength="10" onkeypress="return Numeros(event)">
                                @error('valor') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        <div class="form-group mb-2 col-md-4">
                            <label for="medio_pago_id">Medio de Pago*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="medio_pago_id" id="medio_pago_id" class=" form-control form-select  select" data-pristine-required-message="Campo Requerido">
                                    <option value="">Seleccione..</option>
                                    @foreach($medio_pago as $medio)
                                        <option value={{$medio->id}} data-valor={{$medio->medio_pago}}>{{ $medio->medio_pago }}</option>
                                    @endforeach
                                </select>
                                @error('medio_pago_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        <div class="form-group mb-2 col-md-4">
                            <label for="cuenta_pago_id">Cuenta*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="cuenta_pago_id" id="cuenta_pago_id" class=" form-control form-select  select"  data-pristine-required-message="Campo Requerido">
                                    
                                </select>
                                @error('cuenta_pago_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        <div class="form-group mb-2 col-md-4">
                            <label for="referencia_pago">Referencia de pago*</label>
                            <div>
                            <div class="input-group">                                
                                <input name="referencia_pago" type="text" class="form-control border-gray-300" placeholder="Ej: 00012312321" id="referencia_pago"  maxlength="15" onkeypress="return NumDoc(event)" readonly>
                                @error('referencia_pago') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        <div class="form-group mb-2 col-md-4">
                            <label for="fecha_pago">Fecha de pago*</label>
                            <div>
                            <div class="input-group">                                
                                <input name="fecha_pago" type="date" class="form-control border-gray-300" placeholder="Ej: 00012312321" id="fecha_pago" data-pristine-required-message="Campo Requerido">
                                @error('fecha_pago') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        <div class="form-group mb-2 col-md-4">
                            <label for="observaciones">Observaciones</label>
                            <div>
                            <div class="input-group">                                
                                <textarea name="observaciones" class="form-control border-gray-300" placeholder="Ej: Pago divido en dos" id="observaciones" rows="2" cols="4" style="resize:none;" data-pristine-required-message="Campo Requerido"></textarea>
                                @error('observaciones') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group d-flex justify-content-end">    
                            <button class="btn btn-outline-tertiary btn-md pt-2" type="button" id="addAbonoTable">Añadir <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 256 256"><g fill="currentColor"><path d="M224 128a96 96 0 1 1-96-96a96 96 0 0 1 96 96Z" opacity=".2"/><path d="M128 24a104 104 0 1 0 104 104A104.11 104.11 0 0 0 128 24Zm0 192a88 88 0 1 1 88-88a88.1 88.1 0 0 1-88 88Zm48-88a8 8 0 0 1-8 8h-32v32a8 8 0 0 1-16 0v-32H88a8 8 0 0 1 0-16h32V88a8 8 0 0 1 16 0v32h32a8 8 0 0 1 8 8Z"/></g></svg></button>
                            </div>
                        </div>
                       </div>
                       <div class="row mb-4">
                        <div class="col-md-12">
                        <table class="table table-centered table-nowrap mb-0 rounded overflow-scroll" id="myTableAbono">
                            <thead class="thead-light" style="overflow-x: scroll;">
                                <tr>
                                    <th class="border-0">#</th>
                                    <th class="border-0">Valor</th>
                                    <th class="border-0">Medio de pago</th>
                                    <th class="border-0">Cuenta</th>
                                    <th class="border-0">Fecha de pago</th>
                                    <th class="border-0">Referencia</th>
                                    <th class="border-0">Acciones</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>

                       </div>
                                             
                         
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="id" id="cliente_id">
                            <button type="submit" class="btn btn-primary btnModal-abono">Crear Abono</button>
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>  
    
    {{-- MODAL VIE ABONO --}}
    <div class="modal fade" id="modalViewAbono" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar-view" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo-moda-view">Ver Abonos Disponibles Y Apartados</h2>
                    <form action="#" method="" id="myFormViewAbonos"> 
                        <div class="form-group mb-3">
                            <label for="cliente_abono">Nombre cliente*</label>
                            <div>
                            <div class="input-group">                                
                                <input name="cliente_abono" type="text" class="form-control border-gray-300" placeholder="Ej: Andrea" id="cliente_abono" required data-pristine-required-message="Campo Requerido" onkeyup="aMayusculas(this.value,this.id)" onkeypress="return Letras(event)" readonly>
                                @error('cliente_abono') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>                       
                       
                        <div class="row justify-content-center mb-4">
                      
                            <div class="col-md-12">
                                <table class="table table-centered table-nowrap mb-0 rounded overflow-scroll" id="myTableView" style="overflow-x: scroll;">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="border-0">#</th>
                                            <th class="border-0">Valor</th>
                                            <th class="border-0">Medio de pago</th>
                                            <th class="border-0">Estado</th>
                                            <th class="border-0">Verificado</th>
                                            <th class="border-0">Fecha de Abono</th>
                                            <th class="border-0">Comprobante</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyView">
                                        
                                    </tbody>
                                </table>
                            </div>                        
                            
                        </div>                   
                                          
                        <!-- End of Form -->                        
                        <div class="d-grid">
                           
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div> 
</div>
</div>
@push('scripts-clientes')
<script src="{{asset('js/clientes.js')}}" type="module"></script>
@endpush


@endsection