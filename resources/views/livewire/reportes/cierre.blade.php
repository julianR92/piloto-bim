@extends('layouts.main')

@section('content')
    @php setlocale(LC_MONETARY, 'es_CO'); @endphp
    <style>
        .input-money {
            font-size: 18px;
            font-weight: 700;
        }

        .total-factura {
            font-size: 2.5rem;
            /* Tamaño de la letra */
            font-weight: bold;
            /* Negrita */
            color: #131212;
            /* Color del texto (puedes personalizarlo) */
            margin-bottom: 10px;
            /* Espacio inferior para separar del contenido */
            margin-left: 10px;
            /* Espacio inferior para separar del contenido */
        }

        .profesional {
            font-style: italic;
            font-weight: bold;
            font-size: 18px;
            color: navy;
            /* Color azul oscuro */
        }

        .linea-divisoria {
            border: none;
            /* Quitamos el borde predeterminado */
            height: 3px;
            /* Grosor deseado */
            background-color: #000;
            /* Color de fondo (puedes cambiarlo) */
            margin: 10px 0;
            /* Margen superior e inferior opcional */
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
                                <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Reportes</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cierre Diario</li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between w-100 flex-wrap">
                    <div class="mb-3 mb-lg-0">
                        <h1 class="h4">Reporte de Cierre</h1>
                    </div>
                </div>
            </div>


            <div class="card border-0 shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-2 col-md-3">
                            <label for="fecha_inicial">Fecha Inicial*</label>
                            <div>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="fecha_inicial" id="fecha_inicial"
                                        value="{{ date('Y-m-d') }}">
                                    @error('fecha_inicial')
                                        <div class="invalid-feedback"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2 col-md-3">
                            <label for="fecha_fin">Fecha Fin*</label>
                            <div>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin"
                                        value="{{ date('Y-m-d') }}">
                                    @error('fecha_fin')
                                        <div class="invalid-feedback"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2 col-md-3 mt-1">
                            <a type="button" class="btn btn-info text-white mt-4 btnBuscar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-width="1.5"
                                        d="M9 21h6m-6 0v-5m0 5H3.6a.6.6 0 0 1-.6-.6v-3.8a.6.6 0 0 1 .6-.6H9m6 5V9m0 12h5.4a.6.6 0 0 0 .6-.6V3.6a.6.6 0 0 0-.6-.6h-4.8a.6.6 0 0 0-.6.6V9m0 0H9.6a.6.6 0 0 0-.6.6V16" />
                                </svg> Generar
                            </a>
                        </div>
                    </div>

                    <hr class="linea-divisoria d-none">
                    <div class="table-responsive mt-3">
                        <p id="label-abonos"></p>
                        <table class="table table-centered table-nowrap mb-0 rounded d-none" id="myTableWeekly">

                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0 rounded-start">#</th>
                                    <th class="border-0 rounded-start">Medio de Pago</th>
                                    <th class="border-0 text-center">Cuenta</th>
                                    <th class="border-0">Valor</th>
                                    <th class="border-0 text-center"># Numero</th>


                                </tr>
                            </thead>
                            <tbody id="tbodyView">
                            </tbody>

                        </table>

                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group mb-2 mt-3 divValorGanado d-none">

                                <label for="presentacion">
                                    <h5>Total Abonos:</h5><span id="total_cuenta" class="semi-total-factura"></span>
                                </label>
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="linea-divisoria d-none">

                    {{-- TABLA DE Procedimientos --}}
                    <div class="table-responsive mt-3">
                        <p id="label-procedimientos"></p>
                        <table class="table table-centered table-nowrap mb-0 rounded d-none" id="tableAdicional">

                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0 rounded-start">#</th>
                                    <th class="border-0 rounded-start">Medio de Pago</th>
                                    <th class="border-0 text-center">Cuenta</th>
                                    <th class="border-0">Valor</th>
                                    <th class="border-0 text-center"># Numero</th>


                                </tr>
                            </thead>
                            <tbody id="tbodyViewAdicional">
                            </tbody>

                        </table>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-2 mt-3 divValorGanado2 d-none">
                                <label for="presentacion">
                                    <h5>Total Procedimientos:</h5><span id="total2_cuenta"
                                        class="semi-total-factura"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr class="linea-divisoria d-none">

                    {{-- TABLA DE SERVICIOS --}}
                    <div class="table-responsive mt-3">
                        <p id="label-servicios"></p>
                        <table class="table table-centered table-nowrap mb-0 rounded d-none" id="tableServicios">

                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0 rounded-start">#</th>
                                    <th class="border-0 rounded-start">Medio de Pago</th>
                                    <th class="border-0 text-center">Cuenta</th>
                                    <th class="border-0">Valor</th>
                                    <th class="border-0 text-center"># Numero</th>


                                </tr>
                            </thead>
                            <tbody id="tbodyViewServicios">
                            </tbody>

                        </table>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-2 mt-3 divValorGanado3 d-none">
                                <label for="presentacion">
                                    <h5>Total Servicios:</h5><span id="total3_cuenta" class="semi-total-factura"></span>
                                </label>

                                <br><br>
                                <hr class="linea-divisoria d-none">
                                <p class="profesional d-none" id="mensajeProfesional"></p>
                                <label for="presentacion mt-4">
                                    <h5>Total:</h5><span id="super_total" class="total-factura"></span>
                                </label>
                                <div>
                                </div>
                            </div>

                        </div>
                        <div class="row justify-content-end">
                            <div class="col-md-2 d-none divSalida mt-3">
                                <button type="button" class="btn btn-gray-200 d-inline-flex align-items-right btnSalir">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M3 21v-6h2v4h14V5H5v4H3V3h18v18H3Zm7.5-4l-1.4-1.45L11.65 13H3v-2h8.65L9.1 8.45L10.5 7l5 5l-5 5Z" />
                                    </svg>
                                    Salir
                                </button>
                            </div>

                        </div>
                        <div class="row divCalculos mx-auto">

                        </div>
                    </div>
                    <div class="row divCalculos mx-auto">

                    </div>
                </div>
            </div>

        </div>
    </div>
    @push('scripts-reportes')
        <script src="{{ asset('js/reportes-cierre.js') }}" type="module"></script>
    @endpush
@endsection
