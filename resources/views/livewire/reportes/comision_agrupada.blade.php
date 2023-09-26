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
    .semi-total-factura {
      font-size: 1.5rem; /* Tamaño de la letra */
      font-weight: bold; /* Negrita */
      color: #131212; /* Color del texto (puedes personalizarlo) */
      margin-bottom: 10px; /* Espacio inferior para separar del contenido */
      margin-left: 10px; /* Espacio inferior para separar del contenido */
    }
    .profesional {
    font-style: italic;
    font-weight: bold;
    font-size: 18px;
    color: navy; /* Color azul oscuro */
}

.linea-divisoria {
  border: none; /* Quitamos el borde predeterminado */
  height: 3px; /* Grosor deseado */
  background-color: #000; /* Color de fondo (puedes cambiarlo) */
  margin: 10px 0; /* Margen superior e inferior opcional */
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
                <li class="breadcrumb-item"><a href="#">Reportes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Comision Profesionales Agrupadass</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Comision de Profesionales Agrupada</h1>
            </div>             
        </div>
    </div>
     
    
    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="row">
            <div class="form-group mb-2 col-md-3">
                <label for="profesional">Profesional*</label>
                <div>
                <div class="input-group">                                
                    <select name="profesional" id="profesional" class="form-control form-select" required>
                        <option value="">Seleccione..</option>
                        @foreach($profesionales as $profesional)
                        <option value="{{$profesional->id}}">{{ $profesional->nombres}} {{ $profesional->apellidos}}</option>
                    @endforeach
                    </select>
                    @error('profesional') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                </div>
                </div>
            </div>           
            <div class="form-group mb-2 col-md-2">
                <label for="fecha_inicial">Fecha Inicio*</label>
                <div>
                <div class="input-group">                                
                    <input type="date" class="form-control" name="fecha_inicial" id="fecha_inicial">
                    @error('fecha_inicial') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                </div>
                </div>
            </div>
            <div class="form-group mb-2 col-md-2">
                <label for="fecha_fin">Fecha Fin*</label>
                <div>
                <div class="input-group">                                
                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin">
                    @error('fecha_fin') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                </div>
                </div>
            </div>
            <div class="form-group mb-2 col-md-2 mt-1">
                <a type="button" class="btn btn-success text-white mt-4 btnBuscar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="m15.45 15.05l1.1-1.05l-2.1-2.1q.275-.425.413-.9T15 10q0-1.475-1.038-2.488T11.5 6.5q-1.425 0-2.463 1.012T8 10q0 1.475 1.038 2.488T11.5 13.5q.525 0 .988-.138t.912-.412l2.05 2.1ZM11.5 12q-.825 0-1.413-.588T9.5 10q0-.825.588-1.413T11.5 8q.8 0 1.4.588T13.5 10q0 .825-.588 1.413T11.5 12ZM2 21q-.425 0-.713-.288T1 20q0-.425.288-.713T2 19h20q.425 0 .713.288T23 20q0 .425-.288.713T22 21H2Zm2-3q-.825 0-1.413-.588T2 16V5q0-.825.588-1.413T4 3h16q.825 0 1.413.588T22 5v11q0 .825-.588 1.413T20 18H4Zm0-2h16V5H4v11Zm0 0V5v11Z"/></svg> Buscar
                </a>
            </div>
            </div>

            <div class="table-responsive mt-3">
                <p id="label-procedimientos"></p>
                <table class="table table-centered table-nowrap mb-0 rounded d-none" id="myTableWeekly">
                    
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">#</th>
                            <th class="border-0 rounded-start">Servicio</th>                       
                            <th class="border-0 text-center">Talla</th>
                            <th class="border-0">Valor</th>                          
                            <th class="border-0 text-center"># Servicios Realizados</th>                          
                                                     
                                                      
                        </tr>
                    </thead>
                    <tbody id="tbodyView">
                    </tbody>
                       
                </table> 

            </div>
            <div class="row">
            <div class="col-md-8">
                <div class="form-group mb-2 mt-3 divValorGanado d-none">
                    
                    <label for="presentacion"><h5>Valor Comision:</h5><span id="total_cuenta" class="semi-total-factura"></span></label>
                    <div>                      
                    </div>
                </div>
            </div>            
        </div>
       {{-- TABLA DE ADICIONALES --}}
        <div class="table-responsive mt-3">
            <p id="label-servicios"></p>
            <table class="table table-centered table-nowrap mb-0 rounded d-none" id="tableAdicional">
             
                <thead class="thead-light">
                    <tr>
                        <th class="border-0 rounded-start">#</th>
                        <th class="border-0 rounded-start">Servicio</th>                     
                        <th class="border-0">Valor</th>                          
                        <th class="border-0 text-center"># Servicios Realizados</th>                          
                                                 
                                                  
                    </tr>
                </thead>
                <tbody id="tbodyViewAdicional">
                </tbody>
                   
            </table> 

        </div>
        <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-2 mt-3 divValorGanado2 d-none">              
                <label for="presentacion"><h5>Valor Comision:</h5><span id="total2_cuenta" class="semi-total-factura"></span></label>
                 <br><br>
                 <hr class="linea-divisoria">
                 <p class="profesional d-none" id="mensajeProfesional"></p>
                <label for="presentacion mt-4"><h5>Total:</h5><span id="super_total" class="total-factura"></span></label>
                <div>
                
                <div>                      
                </div>
            </div>
        </div>
        
    </div>
            <div class="row justify-content-end">                
                <div class="col-md-2 d-none divSalida mt-3">
                 <button type="button" class="btn btn-gray-200 d-inline-flex align-items-right btnSalir">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M3 21v-6h2v4h14V5H5v4H3V3h18v18H3Zm7.5-4l-1.4-1.45L11.65 13H3v-2h8.65L9.1 8.45L10.5 7l5 5l-5 5Z"/></svg>
                      Salir
                 </button>
             </div>

             </div>
             <div class="row divCalculos mx-auto">               

             </div>
        </div>
    </div>
      
</div>
</div>
@push('scripts-reportes')
<script src="{{asset('js/reportes-agrupado.js')}}" type="module"></script>
@endpush


@endsection