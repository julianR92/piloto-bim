@extends('layouts.main')

@section('content')
@php setlocale(LC_MONETARY, 'es_CO'); @endphp
<style>
.input-money {
  font-size: 18px; 
  font-weight: 700; 
}
.total-factura {
  font-size: 2.5rem; /* Tamaño de la letra */
  font-weight: bold; /* Negrita */
  color: #131212; /* Color del texto (puedes personalizarlo) */
  margin-bottom: 10px; /* Espacio inferior para separar del contenido */
  margin-left: 10px; /* Espacio inferior para separar del contenido */
}
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
                <li class="breadcrumb-item"><a href="#">Procedimientos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pago Adicionales</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Generar Pago de Servicios Adicionales</h1>
            </div>  
                  
        </div>        
    </div>
     
    
    <div class="card border-0 shadow mb-4">
        <div class="card-body">           
            
            <form action="#" method="" id="myForm">                      
            <div class="row">  
                <div class="col-md-6 mt-2 mb-2">
                <h3>Pago de Servicios Adicionales</h3> 
               </div> 
                 <div class="col-md-6">
                    
                 </div>                
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label for="cliente_id">Cliente*</label>
                            <div class="input-group">
                                <select name="cliente_id" id="cliente_id" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido" autofocus>
                                    <option value="">Seleccione..</option>
                                    @foreach($clientes as $cliente)
                                        <option value={{$cliente->id}}>{{ $cliente->nombres }} {{ $cliente->apellidos }} {{$cliente->documento}}</option>
                                    @endforeach
                                </select>
                                @error('cliente_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                                <span style="font-weight:400;font-size:10px;" id="msgCalificacion"></span>
                            </div>
                         </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <label for="servicio_adicional_id">Servicio*</label>
                        <div>
                        <div class="input-group">                                
                            <select name="servicio_adicional_id" id="servicio_adicional_id" class="form-control form-select  select" required data-pristine-required-message="Campo Requerido">
                                <option value="">Seleccione..</option>
                                @foreach($servicios_adicionales as $servi)
                                <option value={{$servi->id}} data-comision={{$servi->comision}} data-valor={{$servi->valor}}>{{ $servi->nombre}}</option>
                            @endforeach
                            </select>
                            @error('servicio_adicional_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <label for="profesional_id">Profesional*</label>
                        <div>
                        <div class="input-group">                                
                            <select name="profesional_id" id="profesional_id" class="form-control form-select  select" required data-pristine-required-message="Campo Requerido">
                                <option value="">Seleccione..</option>
                                @foreach($profesionales as $profesional)
                                <option value={{$profesional->id}}>{{ $profesional->nombres}} {{ $profesional->apellidos}}</option>
                            @endforeach
                            </select>
                            @error('profesional_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                        </div>
                        </div>
                    </div>
                </div>           
                              
                
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <label for="medio_pago">Medio de pago*</label>
                        <div>
                        <div class="input-group">                                
                            <select name="medio_pago" id="medio_pago" class="form-control form-select  select" required data-pristine-required-message="Campo Requerido">
                                <option value="">Seleccione..</option>
                                @foreach($medios_pago as $metodo)
                                <option value={{$metodo->medio_pago}} data-idMedio={{$metodo->id}}>{{ $metodo->medio_pago}}</option>
                            @endforeach                            
                            <option value="SIN-PAGO" data-idMedio="00">SIN PAGO</option>

                            </select>
                            @error('medio_pago') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cuenta_pago_id">Cuenta*</label>
                        <div>
                        <div class="input-group">                                
                            <select name="cuenta_pago_id" id="cuenta_pago_id" class="form-control form-select  select" required data-pristine-required-message="Campo Requerido">
                                <option value="">Seleccione..</option>
                                @foreach($cuentas as $cuenta)
                                <option value={{$cuenta->id}} data-medioId={{$cuenta->medio_pago_id }}>{{ $cuenta->entidad}} - {{ $cuenta->numero_cuenta}}</option>
                                @endforeach
                                <option value="00" data-medioId="00">SIN PAGO</option>
                            </select>
                            @error('cuenta_pago_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 divReferencia d-none">
                    <div class="form-group">
                        <label for="referencia_pago">Referencia de Pago</label>
                        <div>
                        <div class="input-group">                                
                            <input name="referencia_pago" id="referencia_pago" class="form-control" maxlength="20" onkeypress="return NumDoc(event)" >                              
                            @error('referencia_pago') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="form-group mb-2">
                        <label for="presentacion"><h3>Total:</h3><span id="total_cuenta" class="total-factura"></span></label>
                        <div>                      
                        </div>
                    </div>
                </div>
                    
                                            
                    <!-- End of Form -->                        
                    <div class="d-grid">
                                            
                                            
                        <input type="hidden" name="comision" id="comision" required>  
                        <input type="hidden" name="medio_pago_id" id="medio_pago_id" required>                
                        <input type="hidden" name="valor_pagar" id="valor_pagar"required>
                        <button type="submit" class="btn btn-primary btnModal">Generar Pago</button>
                    </div>
                </div>
            </form>
        </div>
    </div>   
</div>
</div>
@push('scripts-procedimientos')
<script src="{{asset('js/pagos-adicionales.js')}}" type="module"></script>
@endpush


@endsection