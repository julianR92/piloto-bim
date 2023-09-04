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
                <li class="breadcrumb-item"><a href="#">Inventario</a></li>
                <li class="breadcrumb-item active" aria-current="page">Control Semanal</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Administración de Inventario Semanal</h1>
            </div>   
            <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="m8.5 19l2.5-4H9.5v-3L7 16h1.5v3ZM6 10h6V5H6v5ZM4 21V5q0-.825.588-1.413T6 3h6q.825 0 1.413.588T14 5v7h1.25q.725 0 1.238.513T17 13.75v4.625q0 .425.35.775t.775.35q.45 0 .788-.35t.337-.775V9H19q-.425 0-.713-.288T18 8V6h.5V4.5h1V6h1V4.5h1V6h.5v2q0 .425-.288.713T21 9h-.25v9.375q0 1.05-.763 1.838T18.126 21q-1.075 0-1.85-.788t-.775-1.837V13.75q0-.125-.063-.188t-.187-.062H14V21H4Z"/></svg>Realizar Recarga
                </a>
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
            <div class="form-group mb-2 col-md-3">
                <label for="producto">Producto*</label>
                <div>
                <div class="input-group">                                
                    <select name="producto" id="producto" class="form-control form-select" required>
                        <option value="">Seleccione..</option>
                        @foreach($productos as $producto)
                        <option value="{{$producto->id}}">{{ $producto->nombre}}</option>
                    @endforeach
                    </select>
                    @error('producto') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
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
                <table class="table table-centered table-nowrap mb-0 rounded d-none" id="myTableWeekly">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">#</th>
                            <th class="border-0 rounded-start">Fecha</th>
                            <th class="border-0 rounded-start">Tipo</th>
                            <th class="border-0">Producto</th>
                            <th class="border-0">Valor</th>                            
                            <th class="border-0">Profesional</th>                            
                            <th class="border-0">Acciones</th>                           
                        </tr>
                    </thead>
                    <tbody id="tbodyView">
                       
                </table>                
            </div>
            <div class="row justify-content-end">
                <div class="col-md-2 d-none divCalcular mt-3">
                 <button type="button" class="btn btn-info d-inline-flex align-items-right btnCalcular">
                     <svg xmlns="http://www.w3.org/2000/svg" class="btnCalcular" width="24" height="24" viewBox="0 0 24 24"><path fill="#f1efef" class="btnCalcular" d="M8 16v1.25q0 .325.213.537T8.75 18q.325 0 .537-.213t.213-.537V16h1.25q.325 0 .537-.213t.213-.537q0-.325-.213-.537t-.537-.213H9.5v-1.25q0-.325-.213-.537T8.75 12.5q-.325 0-.537.213T8 13.25v1.25H6.75q-.325 0-.537.213T6 15.25q0 .325.213.537T6.75 16H8Zm5.75 1.25h3.5q.325 0 .537-.213T18 16.5q0-.325-.213-.537t-.537-.213h-3.5q-.325 0-.537.213T13 16.5q0 .325.213.537t.537.213Zm0-2.5h3.5q.325 0 .537-.213T18 14q0-.325-.213-.537t-.537-.213h-3.5q-.325 0-.537.213T13 14q0 .325.213.537t.537.213Zm1.75-5.2l.875.875q.225.225.525.225t.525-.225q.2-.2.212-.513t-.187-.537l-.9-.925l.875-.875q.225-.225.225-.525t-.225-.525Q17.2 6.3 16.9 6.3t-.525.225L15.5 7.4l-.875-.875Q14.4 6.3 14.1 6.3t-.525.225q-.225.225-.225.525t.225.525l.875.875l-.9.925q-.2.225-.2.525t.225.525q.225.225.525.225t.525-.225l.875-.875ZM7 9.2h3.5q.325 0 .537-.212t.213-.538q0-.325-.213-.537T10.5 7.7H7q-.325 0-.537.213t-.213.537q0 .325.213.538T7 9.2ZM5 21q-.825 0-1.413-.588T3 19V5q0-.825.588-1.413T5 3h14q.825 0 1.413.588T21 5v14q0 .825-.588 1.413T19 21H5Zm0-2h14V5H5v14ZM5 5v14V5Z"/></svg>
                      Calcular
                 </button>
             </div>
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
    {{-- MODAL --}}
    <div class="modal fade" id="modalSignIn" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo-modal">Recargar Inventario</h2>
                    <form action="#" method="" id="myForm">
                        
                      
                        <div class="form-group mb-2">
                            <label for="profesional_mo">Profesional*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="profesional_mo" id="profesional_mo" class="form-control form-select" required autofocus>
                                    <option value="">Seleccione..</option>
                                    @foreach($profesionales as $profesional)
                                    <option value="{{$profesional->id}}">{{ $profesional->nombres}} {{ $profesional->apellidos}}</option>
                                @endforeach
                                </select>
                                @error('profesional') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label for="producto_mo">Producto*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="producto_mo" id="producto_mo" class="form-control form-select" required>
                                    <option value="">Seleccione..</option>
                                    @foreach($productos as $producto)
                                    <option value="{{$producto->id}}">{{ $producto->nombre}}</option>
                                @endforeach
                                </select>
                                @error('producto_mo') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="tipo_transaccion">Tipo*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="tipo_transaccion" id="tipo_transaccion" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido" >
                                    <option value="">Seleccione..</option>
                                    @foreach($tipos as $key=>$value)
                                    <option value={{$value}}>{{ $value}}</option>
                                @endforeach
                                </select>
                                @error('tipo_transaccion') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="fecha">Fecha*</label>
                            <div>
                            <div class="input-group">                                
                                <input name="fecha" type="date" class="form-control border-gray-300"  id="fecha" required data-pristine-required-message="Campo Requerido" value="{{date('Y-m-d')}}">
                                @error('fecha') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="permiso">Cantidad en Gramos(Gr)*</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M128 20a108 108 0 1 0 108 108A108.12 108.12 0 0 0 128 20Zm0 192a84 84 0 1 1 84-84a84.09 84.09 0 0 1-84 84Zm44-64a32 32 0 0 1-32 32v4a12 12 0 0 1-24 0v-4h-12a12 12 0 0 1 0-24h36a8 8 0 0 0 0-16h-24a32 32 0 0 1 0-64v-4a12 12 0 0 1 24 0v4h12a12 12 0 0 1 0 24h-36a8 8 0 0 0 0 16h24a32 32 0 0 1 32 32Z"/></svg>
                                </span>
                                <input name="valor" type="text" class="form-control border-gray-300" placeholder="Ej: 1000" id="valor" required data-pristine-required-message="Campo Requerido" onkeypress="return Numeros(event)" data-pristine-type="integer">
                                @error('valor') <div class="invalid-feedback" > {{ $message }} </div> @enderror 
                            </div> 
                        </div>                         
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-primary btnModal">Añadir Inventario</button>
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>    
</div>
</div>
@push('scripts-inventarios')
<script src="{{asset('js/producto-semana.js')}}" type="module"></script>
@endpush


@endsection