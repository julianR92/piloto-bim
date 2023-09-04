@extends('layouts.main_agenda')

@section('content')
    <style>
        .bg-agendado{
            background: #A1FAB2;
        }
    </style>
<div>
    {{-- Be like water. --}}
    <div>
        

    <div class="py-4">        
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="/dashboard">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#">Agenda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ver Agenda</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <a href="/dashboard" class="text-info me-3 float-end"><svg width="16" height="16" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M3.97 12c0 4.41 3.62 8.03 8.03 8.03c4.41 0 8.03-3.62 8.03-8.03c0-4.41-3.62-8.03-8.03-8.03c-4.41 0-8.03 3.62-8.03 8.03M2 12C2 6.46 6.46 2 12 2s10 4.46 10 10s-4.46 10-10 10S2 17.54 2 12m8.46-1V8L6.5 12l3.96 4v-3h7.04v-2"/></svg>Volver al Sistema</a></div>
            </div> 
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Agenda</h1>
            </div>   
            {{-- <div>
                
            </div>          --}}
        </div>
    </div>
 <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-12 mr-2">
        <div class="mb-3">
            <a type="button" href="" class="btn btn-info d-inline-flex align-items-center btn-modal" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M12 22H3V4h3V2h2v2h8V2h2v2h3v8h-2v-2H5v10h7v2zm10.13-5.01l1.41-1.41l-2.12-2.12l-1.41 1.41l2.12 2.12zm-.71.71l-5.3 5.3H14v-2.12l5.3-5.3l2.12 2.12z"/></svg>&nbsp;&nbsp;Config Agenda
            </a>
        </div>
        <div class="mb-3">            
                <div id="date">
                </div>                                        
          
        </div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12">
        <div class="row justify-content-center pt-4 d-none" id="box_loader">
        <div class="loader">
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
        </div>
        <p class="text-center pt-3">Cargando...</p>
        </div>
        
        <div class="mb-3" id="box_table">   
       <h3 class="text-success" id='fecha_actual'></h3>         
        <div class="card border-0 shadow mb-4 table-agenda">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded" id="myTable" data-toggle="table" data-row-style="rowStyle" data-search="true" data-pagination="true" data-page-size="25" >
                    <thead class="thead-light">
                        <tr>
                            <th data-field="asignar" class="border-0 rounded-start">Asignar</th>
                            <th data-field="hora" class="border-0">Hora</th>
                            <th data-field="tipo_servicio" class="border-0">Tipo Servicio</th>
                            <th data-field="estado" class="border-0">Estado</th>
                            <th data-field="nombre" class="border-0">Nombre</th>
                            <th data-field="telefono" class="border-0">Telefono</th>
                            <th data-field="instagram" class="border-0">Instagram</th>
                            <th data-field="abono" class="border-0">Abono</th>
                            <th data-field="observacion" class="border-0">Observacion</th>

                            
                            
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyColectivo">
                        @foreach ($data as $datos)
                        <tr>

                           <td>@if($datos->estado == 'DISPONIBLE')
                            <a title="asignar cita"  class="btn-cita" data-id="{{$datos->id}}" data-tipo="{{$datos->tipo_servicio_id}}" data-hora="{{$datos->hora}}"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" class="btn-cita" data-id="{{$datos->id}}" data-tipo="{{$datos->tipo_servicio_id}}"  data-hora="{{$datos->hora}}"><path  class="btn-cita" data-id="{{$datos->id}}" data-tipo="{{$datos->tipo_servicio_id}}"  data-hora="{{$datos->hora}}" fill="#e40707" d="M17 14v3h-3v2h3v3h2v-3h3v-2h-3v-3M12 2a2 2 0 0 0-2 2a2 2 0 0 0 0 .29C7.12 5.14 5 7.82 5 11v6l-2 2v1h9.35a6 6 0 0 1-.35-2a6 6 0 0 1 6-6a6 6 0 0 1 1 .09V11c0-3.18-2.12-5.86-5-6.71A2 2 0 0 0 14 4a2 2 0 0 0-2-2m-2 19a2 2 0 0 0 2 2a2 2 0 0 0 1.65-.87a6 6 0 0 1-.84-1.13Z"/></svg></a>
                            @elseif($datos->estado == 'AGENDADO')

                            <a title="editar cita" class="btn-update-cita" data-nombre="{{ $datos->nombres }} {{$datos->apellidos}}" data-id="{{$datos->id}}"  data-hora="{{$datos->hora}}"><svg xmlns="http://www.w3.org/2000/svg" class="btn-update-cita" width="32" height="32" viewBox="0 0 256 256" class="btn-update-cita" data-nombre="{{ $datos->nombres }} {{$datos->apellidos}}" data-id="{{$datos->id}}" data-hora="{{$datos->hora}}"><path class="btn-update-cita" data-nombre="{{ $datos->nombres }} {{$datos->apellidos}}" data-id="{{$datos->id}}" data-hora="{{$datos->hora}}" fill="#e3e718" d="M225.91 74.79L181.22 30.1a14 14 0 0 0-19.8 0L38.1 153.41a13.94 13.94 0 0 0-4.1 9.9V208a14 14 0 0 0 14 14h168a6 6 0 0 0 0-12H110.49L225.91 94.59a14 14 0 0 0 0-19.8ZM76.49 188L164 100.48L183.52 120L96 207.51ZM68 179.52L48.49 160L136 72.49L155.52 92ZM46 208v-33.52L81.52 210H48a2 2 0 0 1-2-2ZM217.42 86.1L192 111.52L144.49 64l25.41-25.41a2 2 0 0 1 2.83 0l44.69 44.68a2 2 0 0 1 0 2.83Z"/></svg></a>

                            @endif
                            
                            </td>
                           <td>{{ $datos->hora }}</td>
                           <td>{{ $datos->tipo_servicio }}-{{ $datos->servicio }}</td>
                           <td>{{ $datos->estado }} </td>
                           <td>{{ $datos->nombres }} {{ $datos->apellidos }}</td>
                           <td>{{ $datos->telefono }}</td>
                           <td>{{ $datos->instagram }}</td>
                           <td id="format">{{ $datos->valor }}</td>
                           <td>{{ $datos->observacion }}</td>                          
                        </tr>
                     @endforeach
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>                                      
          
        </div>
    </div>
</div>
     
    
    
    {{-- MODAL --}}
    <div class="modal fade" id="modalSignIn" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo-modal pb-3">Configurar Agenda</h2>
                    <form action="#" method="" id="myForm">                        
                        <div class="row">
                        <div class="col-md-6 col-sm-12">
                        <div class="form-group mb-2">
                            <label for="fecha_inicio">Fecha Inicial*</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20a2 2 0 0 0 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zM9 14H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm-8 4H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2z"/></svg>
                                </span>
                                <input name="fecha_inicio" type="date" class="form-control border-gray-300" id="fecha_inicio" required data-pristine-required-message="Campo Requerido">
                                @error('fecha_inicio') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                         </div>
                         </div> 
                        <div class="col-md-6 col-sm-12">
                        <div class="form-group mb-2">
                            <label for="fecha_fin">Fecha Fin*</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20a2 2 0 0 0 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zM9 14H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm-8 4H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2z"/></svg>
                                </span>
                                <input name="fecha_fin" type="date" class="form-control border-gray-300" id="fecha_fin" required data-pristine-required-message="Campo Requerido">
                                @error('fecha_fin') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                         </div>
                         </div> 
                        <div class="col-md-12 col-sm-12">                       
                            <div class="form-group mb-2">
                                <label for="tipo_servicio_id">Tipo de servicio*</label>
                                <div>
                                <div class="input-group">                                
                                    <select name="tipo_servicio_id" id="tipo_servicio_id" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido" autofocus>
                                        <option value="">Seleccione..</option>
                                        @foreach($tipo_servicio as $tipo)
                                            <option value={{$tipo->id}}>{{ $tipo->tipo_servicio }}</option>
                                        @endforeach
                                    </select>
                                    @error('tipo_servicio_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                                </div>
                                </div>                            
                         </div>
                         </div> 
                        <div class="col-md-6 col-sm-12">                       
                            <div class="form-group mb-2">
                                <label for="servicios_mañana"># de servicios en la Mañana</label>
                                <div>
                                <div class="input-group">                                
                                    <input name="servicios_mañana" type="text" class="form-control border-gray-300" placeholder="Ej: 5" id="servicios_mañana" max='15' onkeypress="return Numeros(event)" data-pristine-type="integer">
                                @error('servicios_mañana') <div class="invalid-feedback" > {{ $message }} </div> @enderror                                     
                                </div>
                                </div>                            
                         </div>
                         </div> 
                        <div class="col-md-6 col-sm-12">                       
                            <div class="form-group mb-2">
                                <label for="horarios_mañana">Horarios en la Mañana</label>
                                <div>
                                <div class="input-group">                                
                                    <select name="horarios_mañana" id="horarios_mañana" class=" form-control form-select select">
                                        <option value="">Seleccione..</option>
                                        @foreach($horarios_mañana as $key=>$value)
                                            <option value={{$value}}>{{ $value}}</option>
                                        @endforeach
                                    </select>
                                @error('horarios_mañana') <div class="invalid-feedback" > {{ $message }} </div> @enderror                                     
                                </div>
                                </div>                            
                         </div>
                         </div> 
                        <div class="col-md-6 col-sm-12">                       
                            <div class="form-group mb-4">
                                <label for="servicios_tarde"># de servicios en la Tarde</label>
                                <div>
                                <div class="input-group">                                
                                    <input name="servicios_tarde" type="text" class="form-control border-gray-300" placeholder="Ej: 5" id="servicios_tarde" max='15' onkeypress="return Numeros(event)" data-pristine-type="integer">
                                @error('servicios_tarde') <div class="invalid-feedback" > {{ $message }} </div> @enderror                                     
                                </div>
                                </div>                            
                         </div>
                         </div> 
                        <div class="col-md-6 col-sm-12">                       
                            <div class="form-group mb-4">
                                <label for="horarios_tarde">Horarios en la Tarde</label>
                                <div>
                                <div class="input-group">                                
                                    <select name="horarios_tarde" id="horarios_tarde" class=" form-control form-select select">
                                        <option value="">Seleccione..</option>
                                        @foreach($horarios_tarde as $key=>$value)
                                            <option value={{$value}}>{{ $value}}</option>
                                        @endforeach
                                    </select>
                                @error('horarios_tarde') <div class="invalid-feedback" > {{ $message }} </div> @enderror                                     
                                </div>
                                </div>                            
                         </div>
                         </div> 
                         </div>
                         <div class="d-flex justify-content-center">                         
                            <div class="div-loading d-none" id="div-loading">
                            <div class="loading">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                              </div>
                              <small><b>Configurando..</b></small>
                            </div>
                           
                         </div>
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-primary btnModal">Crear Agenda</button>
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>  
    
    {{-- MODAL --}}
    <div class="modal fade" id="myModalAsignar" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar-asignar" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo-modal pb-3">Asignar Agenda</h2>
                    <form action="#" method="" id="myFormAsignar">                        
                        <div class="row">
                        <div class="col-md-12 col-sm-12">
                        <div class="form-group mb-2">
                            <label for="cliente_id">Cliente*</label>
                            <div class="input-group">
                                <select name="cliente_id" id="cliente_id" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido" autofocus>
                                    <option value="">Seleccione..</option>
                                    @foreach($clientes as $cliente)
                                        <option value={{$cliente->id}} data-calificacion={{$cliente->calificacion_id}}>{{ $cliente->nombres }} {{ $cliente->apellidos }} {{$cliente->documento}}</option>
                                    @endforeach
                                </select>
                                @error('cliente_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                                <span style="font-weight:400;font-size:10px;" id="msgCalificacion"></span>
                            </div>
                         </div>
                         </div> 
                         <div class="col-md-6 col-sm-6">                       
                            <div class="form-group mb-2">
                                <label for="tipo_servicio_id_agenda">Tipo de servicio*</label>
                                <div>
                                <div class="input-group">                                
                                    <select name="tipo_servicio_id_agenda" id="tipo_servicio_id_agenda" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido">
                                        <option value="">Seleccione..</option>
                                        @foreach($tipo_servicio as $tipo)
                                            <option value={{$tipo->id}}>{{ $tipo->tipo_servicio }}</option>
                                        @endforeach
                                    </select>
                                    @error('tipo_servicio_id_agenda') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                                </div>
                                </div>                            
                         </div>
                         </div> 
                         <div class="col-md-6 col-sm-6">                       
                            <div class="form-group mb-2">
                                <label for="servicio_id">Servicio*</label>
                                <div>
                                <div class="input-group">                                
                                    <select name="servicio_id" id="servicio_id" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido">
                                        
                                    </select>
                                    @error('servicio_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                                </div>
                                </div>                            
                         </div>
                         </div> 
                         <div class="col-md-6 col-sm-12">                       
                            <div class="form-group mb-2">
                                <label for="horarios_full">Horario*</label>
                                <div>
                                <div class="input-group">                                
                                    <select name="horarios_full" id="horarios_full" class=" form-control form-select select" required data-pristine-required-message="Campo Requerido">
                                        <option value="">Seleccione..</option>
                                        @foreach($horarios_full as $key=>$value)
                                            <option value={{$value}}>{{ $value}}</option>
                                        @endforeach
                                    </select>
                                @error('horarios_full') <div class="invalid-feedback" > {{ $message }} </div> @enderror                                     
                                </div>
                                </div>                            
                         </div>
                         </div> 

                         <div class="col-md-6 col-sm-6">                       
                            <div class="form-group mb-2">
                                <label for="abono_id">Abono Disponibles*</label>
                                <div>
                                <div class="input-group">                                
                                    <select name="abono_id" id="abono_id" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido">
                                        
                                    </select>
                                    
                                    @error('abono_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                                </div>
                                <span class="text-danger " style="font-weight:bold;font-size:10px;" id="msgAbonos"></span>
                                </div>                            
                         </div>
                         </div> 
                         <div class="col-md-12 col-sm-12 mb-3">                       
                            <div class="form-group mb-2">
                                <label for="observacion">Observacion</label>
                                <div>
                                <div class="input-group">                                
                                    <textarea style="resize:none;" name="observacion" class="form-control border-gray-300" id="observacion" maxlength="200" onkeypress="return NumDoc(event)" onkeyup="aMayusculas(this.value,this.id)"></textarea>
                                @error('observacion') <div class="invalid-feedback" > {{ $message }} </div> @enderror                                     
                                </div>
                                </div>                            
                         </div>
                         </div>                     
                        
                        
                       
                       
                         </div>
                      
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="agenda_id" id="agenda_id">
                            <button type="submit" class="btn btn-primary btnModal-asignar">Asignar Agenda</button>
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL --}}
    <div class="modal fade" id="myModalEditar" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar-editar" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo-modal pb-3">Editar Cita</h2>
                    <form action="#" method="" id="myFormEditar">                        
                        <div class="row">
                            <div class="col-md-12 col-sm-12">                       
                                <div class="form-group mb-2">
                                    <label for="cita">Cita*</label>
                                    <div>
                                    <div class="input-group">                                
                                        <input name="cita" type="text" class="form-control border-gray-300" id="cita" readonly>
                                        @error('cita') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                                    </div>
                                    </div>                           
                             </div>
                             </div>                         
                         <div class="col-md-12 col-sm-12">                       
                            <div class="form-group mb-2">
                                <label for="estado_abono">Estado*</label>
                                <div>
                                <div class="input-group">                                
                                    <select name="estado_abono" id="estado_abono" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido">
                                        <option value="">Seleccione..</option>
                                        <option value="APLAZADO">APLAZADO</option>
                                        <option value="CANCELADO">CANCELADO</option>
                                       
                                    </select>
                                    @error('estado_abono') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                                </div>
                                </div>                           
                         </div>
                         </div>                      
                        
                         
                         <div class="col-md-12 col-sm-12 mb-3">                       
                            <div class="form-group mb-2">
                                <label for="observacion_editar">Observacion*</label>
                                <div>
                                <div class="input-group">                                
                                    <textarea style="resize:none;" name="observacion_editar" class="form-control border-gray-300" id="observacion_editar" maxlength="200" onkeypress="return NumDoc(event)" required required data-pristine-required-message="Campo Requerido" onkeypress="return NumDoc(event)" onkeyup="aMayusculas(this.value,this.id)"></textarea>
                                @error('observacion_editar') <div class="invalid-feedback" > {{ $message }} </div> @enderror                                     
                                </div>
                                </div>                            
                         </div>
                         </div>                     
                        
                        
                       
                       
                         </div>
                      
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="agenda_id_edit" id="agenda_id_edit">
                            <button type="submit" class="btn btn-primary btnModal-editar">Editar Cita</button>
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@push('scripts-agenda')
<script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.1/dist/js/locales/es.js"></script>
<script src="{{asset('js/agenda.js')}}" type="module"></script>


<script>
    function rowStyle(row, index) {
      if (row.estado==='AGENDADO') {
      return {
        classes: 'bg-agendado'
      }
    }
    return {
      css: {
        color: 'black'
      }
    }
}
 
</script>
@endpush


@endsection