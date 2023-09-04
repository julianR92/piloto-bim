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
                <li class="breadcrumb-item"><a href="/abonos">Abonos</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$cliente->documento}}</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h3 class="h5">Abonos de {{$cliente->nombres}} {{$cliente->apellidos}}</h3>
                <h5 class="h6">CC {{$cliente->documento}}</h5>
            </div>   
            <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal11" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M12.025 21q-.425 0-.713-.288T11.025 20v-1.15Q9.9 18.6 9.05 17.975t-1.375-1.75q-.175-.35-.012-.738t.587-.562q.35-.15.725.013t.575.537q.425.75 1.075 1.137t1.6.388q1.025 0 1.737-.463t.713-1.437q0-.875-.55-1.387t-2.55-1.163q-2.15-.675-2.95-1.613t-.8-2.287q0-1.625 1.05-2.525t2.15-1.025V4q0-.425.288-.713T12.024 3q.425 0 .713.288t.287.712v1.1q.95.15 1.65.613t1.15 1.137q.225.325.088.725t-.563.575q-.35.15-.725.013t-.7-.488q-.325-.35-.763-.537t-1.087-.188q-1.1 0-1.675.488T9.825 8.65q0 .825.75 1.3t2.6 1q1.725.5 2.613 1.588t.887 2.512q0 1.775-1.05 2.7t-2.6 1.15V20q0 .425-.288.713t-.712.287Z"/></svg>Asignar Abono
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
                            <th data-field="valor" class="border-0">Valor</th>
                            <th data-field="referencia" class="border-0">Referencia</th>
                            <th data-field="estado" class="border-0">Estado</th>
                            <th data-field="verificado" class="border-0">Verificado</th>
                            <th data-field="fecha" class="border-0">Fecha</th>
                            <th class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyColectivo">
                        @foreach($abonos_clientes as $abonos)
                         <tr>
                            <td>{{$abonos->id}}</td>
                            <td>{{$abonos->medio_pago}}</td>
                            <td id="format">{{$abonos->valor}}</td>
                            <td>{{$abonos->referencia_pago? $abonos->referencia_pago: 'SIN REFERENCIA'}}</td>
                            <td>
                                @switch($abonos->estado)
                                @case('PENDIENTE')
                                ⏳{{$abonos->estado}}
                                    @break                            
                                @case('DISPONIBLE')
                                📌{{$abonos->estado}}&nbsp;&nbsp; <a title="Descargar Comprobante" href="/download/comprobante/{{$abonos->id}}" class="btnComprobante">
                                    <button type="button" class="btn btn-info btnComprobante btn-xs" data-id="${el.id}" titlle="descargar comprobante">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="btnComprobante" data-id="${el.id}" width="16" height="16" viewBox="0 0 24 24"><path class="btnComprobante" data-id="${el.id}" fill="currentColor" d="M12 15.575q-.2 0-.375-.062T11.3 15.3l-3.6-3.6q-.275-.275-.275-.7t.275-.7q.275-.275.713-.287t.712.262L11 12.15V5q0-.425.288-.713T12 4q.425 0 .713.288T13 5v7.15l1.875-1.875q.275-.275.713-.263t.712.288q.275.275.275.7t-.275.7l-3.6 3.6q-.15.15-.325.213t-.375.062ZM6 20q-.825 0-1.413-.588T4 18v-2q0-.425.288-.713T5 15q.425 0 .713.288T6 16v2h12v-2q0-.425.288-.713T19 15q.425 0 .713.288T20 16v2q0 .825-.588 1.413T18 20H6Z"/></svg>
                                    </button>
                                    </a>  
                                    @break
                                @case('APARTADO')
                                ✋{{$abonos->estado}}&nbsp;&nbsp; <a title="Descargar Comprobante" href="/download/comprobante/{{$abonos->id}}" class="btnComprobante">
                                    <button type="button" class="btn btn-info btnComprobante btn-xs" data-id="${el.id}" titlle="descargar comprobante">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="btnComprobante" data-id="${el.id}" width="16" height="16" viewBox="0 0 24 24"><path class="btnComprobante" data-id="${el.id}" fill="currentColor" d="M12 15.575q-.2 0-.375-.062T11.3 15.3l-3.6-3.6q-.275-.275-.275-.7t.275-.7q.275-.275.713-.287t.712.262L11 12.15V5q0-.425.288-.713T12 4q.425 0 .713.288T13 5v7.15l1.875-1.875q.275-.275.713-.263t.712.288q.275.275.275.7t-.275.7l-3.6 3.6q-.15.15-.325.213t-.375.062ZM6 20q-.825 0-1.413-.588T4 18v-2q0-.425.288-.713T5 15q.425 0 .713.288T6 16v2h12v-2q0-.425.288-.713T19 15q.425 0 .713.288T20 16v2q0 .825-.588 1.413T18 20H6Z"/></svg>
                                    </button>
                                    </a>  
                                    @break
                                @case('GASTADO')
                                ✅{{$abonos->estado}}
                                    @break                            
                                @case('DEVUELTO')
                                ↩️{{$abonos->estado}}
                                    @break                            
                                @default
                                {{$abonos->estado}}
                            @endswitch
                            </td>
                            <td>{{$abonos->verificado ? 'Verficado ✔️': 'No Verficado⛔'}}</td>
                            <td>{{$abonos->created_at}}</td>
                            <td>
                            <button type="button" class="btn btn-success d-inline-flex align-items-center editarData" data-id="{{$abonos->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>
                              
                            <button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarData" data-id="{{$abonos->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>
                               
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
                    <a href="/abonos" class="text-info me-3 float-end"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3.97 12c0 4.41 3.62 8.03 8.03 8.03c4.41 0 8.03-3.62 8.03-8.03c0-4.41-3.62-8.03-8.03-8.03c-4.41 0-8.03 3.62-8.03 8.03M2 12C2 6.46 6.46 2 12 2s10 4.46 10 10s-4.46 10-10 10S2 17.54 2 12m8.46-1V8L6.5 12l3.96 4v-3h7.04v-2"/></svg>Atras</a></div>
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
                    <h2 class="h4 text-center titulo-modal">Crear Abono</h2>
                    <form action="#" method="" id="myForm">
                        
                        <div class="form-group mb-2">
                            <label for="medio_pago_id">Medio de Pago*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="medio_pago_id" id="medio_pago_id" class=" form-control form-select  select" data-pristine-required-message="Campo Requerido" required>
                                    <option value="">Seleccione..</option>
                                    @foreach($medio_pago as $medio)
                                        <option value={{$medio->id}} data-valor={{$medio->medio_pago}}>{{ $medio->medio_pago }}</option>
                                    @endforeach
                                </select>
                                @error('medio_pago_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label for="cuenta_pago_id">Cuenta*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="cuenta_pago_id" id="cuenta_pago_id" class=" form-control form-select  select"  data-pristine-required-message="Campo Requerido" required>
                                    <option value="">Seleccione..</option>
                                    @foreach($cuentas as $cuenta)
                                        <option value={{$cuenta->id}} data-medio={{$cuenta->medio_pago_id}}>{{ $cuenta->entidad }} -- {{$cuenta->numero_cuenta}}</option>
                                    @endforeach
                                    
                                </select>
                                @error('cuenta_pago_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label for="valor">Valor*</label>
                            <div>
                                <div class="input-group">                                
                                    <input name="valor" type="text" class="form-control border-gray-300" placeholder="Ej: 40000" id="valor" data-pristine-required-message="Campo Requerido" data-pristine-type="integer" maxlength="10" onkeypress="return Numeros(event)" required>
                                    @error('valor') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="referencia_pago">Referencia de pago</label>                           
                            <div class="input-group">                                
                                <input name="referencia_pago" type="text" class="form-control border-gray-300" placeholder="Ej: 00012312321" id="referencia_pago"  maxlength="15" onkeypress="return NumDoc(event)" readonly data-pristine-required-message="Campo Requerido" required value="SIN REFERENCIA">
                                @error('referencia_pago') <div class="invalid-feedback"> {{ $message }} </div> @enderror                             
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="fecha_pago">Fecha de pago*</label>
                            <div>
                            <div class="input-group">                                
                                <input name="fecha_pago" type="date" class="form-control border-gray-300"  id="fecha_pago" data-pristine-required-message="Campo Requerido" required>
                                @error('fecha_pago') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="observaciones">Observaciones</label>
                            <div>
                            <div class="input-group">                                
                                <textarea name="observaciones" class="form-control border-gray-300" placeholder="Ej: Pago divido en dos" id="observaciones" rows="2" cols="4" style="resize:none;" data-pristine-required-message="Campo Requerido"></textarea>
                                @error('observaciones') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="permiso">Estado *</label>
                            <div class="input-group">
                                <select name="estado" id="estado" class=" form-control form-select select"
                                required data-pristine-required-message="Campo Requerido">
                                <option value="">Seleccione..</option>
                                 @foreach ($estado_abonos as $key => $value)
                                <option value="{{$value}}">{{$value}}</option>
                                 @endforeach
                            </select>
                            @error('estado')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                            </div> 
                        </div> 
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="cliente_id" id="cliente_id" value="{{$cliente->id}}">
                            <button type="submit" class="btn btn-primary btnModal">Crear Abono</button>
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>     
</div>
</div>
@push('scripts-clientes')
<script src="{{asset('js/abonos.js')}}" type="module"></script>
@endpush



@endsection