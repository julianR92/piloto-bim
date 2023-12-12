@extends('layouts.main')

@section('content')
    <div>
        <style>
            .card-new {
                padding: 1rem;
                background-color: #fff;
                max-width: 320px;
                max-height: 400px;
                height: 180px;
                border-radius: 20px;
                box-shadow: 10px 10px #323232;
                border: 3px solid #323232;
                cursor: pointer;
            }

            .card-new:hover {
                transform: scale(1.1, 1.1);

            }

            .title {
                display: flex;
                align-items: center;
            }

            .title span {
                position: relative;
                padding: 0.5rem;
                background-color: #10B981;
                width: 1.5rem;
                height: 1.5rem;
                border-radius: 9999px;
            }

            .title span svg {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                color: #ffffff;
                height: 1rem;
            }

            .title-text {
                margin-left: 0.5rem;
                color: #374151;
                font-size: 15px;
            }

            .percent {
                margin-left: 0.5rem;
                color: #02972f;
                font-weight: 600;
                display: flex;
            }

            .data {
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
            }

            .data p {
                margin-top: 1rem;
                margin-bottom: 1rem;
                color: #1F2937;
                font-size: 2.25rem;
                line-height: 2.5rem;
                font-weight: 700;
                text-align: left;
            }

            .data .range {
                position: relative;
                background-color: #E5E7EB;
                width: 100%;
                height: 0.5rem;
                border-radius: 0.25rem;
            }

            .data .range .fill {
                position: absolute;
                top: 0;
                left: 0;
                background-color: #10B981;
                width: 76%;
                height: 100%;
                border-radius: 0.25rem;
            }

            #chartdiv {
                width: 100%;
                height: 600px;
            }
        </style>
        {{-- Be like water. --}}
        <div class="px-4">
            <div class="py-4 px-4">
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
                        <li class="breadcrumb-item"><a href="#">Modulo de Indicadores </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Indicadores</li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between w-100 flex-wrap">
                    <div class="mb-3 mb-lg-0">


                    </div>
                    {{-- <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 14 14"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><rect width="3.5" height="3.5" x=".5" y="10" rx=".5"/><rect width="3.5" height="3.5" x="10" y="10" rx=".5"/><rect width="4" height="4" x="5" y=".5" rx=".5"/><path d="M4 12h6M5.09 4.29L2.5 10m6.41-5.71L11.5 10"/></g></svg>Crear Metodologia
                </a>
            </div>          --}}
                </div>
            </div>

            <div class="card border-0 shadow mb-5">
                <div class="card-body">
                    <div class="table-responsive" style="overflow-x:inherit!important;">
                        <div class="row">
                            <div class="col-md-2">

                                <div class="card-new">
                                    <div class="title">
                                        <span style="background-color: #D22FEC">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="#ededed"
                                                    d="m2.75 19.25l5.325-5.325q.575-.575 1.425-.575t1.425.575L13.5 16.5l6.4-7.225q.275-.325.713-.325t.737.3q.275.275.287.663t-.262.687L14.9 17.9q-.575.65-1.425.688T12 18l-2.5-2.5l-5.25 5.25q-.325.325-.75.325t-.75-.325q-.325-.325-.325-.75t.325-.75Zm0-6l5.325-5.325Q8.65 7.35 9.5 7.35t1.425.575L13.5 10.5l6.4-7.225q.275-.325.713-.325t.737.3q.275.275.287.662t-.262.688L14.9 11.9q-.575.65-1.425.688T12 12L9.5 9.5l-5.25 5.25q-.325.325-.75.325t-.75-.325q-.325-.325-.325-.75t.325-.75Z" />
                                            </svg>
                                        </span>
                                        <p class="title-text">
                                            Indicadores
                                        </p>
                                        {{-- <p class="percent">
                                           <svg width="20" height="20" fill="currentColor" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1408 1216q0 26-19 45t-45 19h-896q-26 0-45-19t-19-45 19-45l448-448q19-19 45-19t45 19l448 448q19 19 19 45z">
                                                </path>
                                            </svg> 20%
                                        </p> --}}
                                    </div>
                                    <div class="data">
                                        <p id="textIndicador" style="text-align: center">
                                            0
                                        </p>

                                        <div class="range">
                                            <div class="fill" id="rangeIndicador"
                                                style="background-color: #D22FEC; width:0%">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-2">

                                <div class="card-new">
                                    <div class="title">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <circle cx="7.2" cy="14.4" r="3.2" fill="#ededed" />
                                                <circle cx="14.8" cy="18" r="2" fill="#ededed" />
                                                <circle cx="15.2" cy="8.8" r="4.8" fill="#ededed" />
                                            </svg>
                                        </span>
                                        <p class="title-text">
                                            Hitos
                                        </p>
                                        {{-- <p class="percent">
                                           <svg width="20" height="20" fill="currentColor" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1408 1216q0 26-19 45t-45 19h-896q-26 0-45-19t-19-45 19-45l448-448q19-19 45-19t45 19l448 448q19 19 19 45z">
                                                </path>
                                            </svg> 20%
                                        </p> --}}
                                    </div>
                                    <div class="data">
                                        <p id="textHito" style="text-align: center">
                                            0
                                        </p>

                                        <div class="range">
                                            <div class="fill" id="rangeHito" style="width: 0%">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-2">

                                <div class="card-new">
                                    <div class="title">
                                        <span style="background-color: #FDFD5E">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="#cfc4c4"
                                                    d="M2 2h2v18h18v2H2V2m5 8h10v3H7v-3m4 5h10v3H11v-3M6 4h16v4h-2V6H8v2H6V4Z" />
                                            </svg>
                                        </span>
                                        <p class="title-text">
                                            Fases
                                        </p>
                                        {{-- <p class="percent">
                                           <svg width="20" height="20" fill="currentColor" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1408 1216q0 26-19 45t-45 19h-896q-26 0-45-19t-19-45 19-45l448-448q19-19 45-19t45 19l448 448q19 19 19 45z">
                                                </path>
                                            </svg> 20%
                                        </p> --}}
                                    </div>
                                    <div class="data">
                                        <p id="textFase" style="text-align: center">
                                            0
                                        </p>

                                        <div class="range">
                                            <div class="fill" id="rangeFase" style="background-color: #FDFD5E; width:0%">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-2">

                                <div class="card-new">
                                    <div class="title">
                                        <span style="background-color: #FC6B3D">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="#ffffff"
                                                    d="M19.5 17c-.13 0-.26 0-.39.04l-1.61-3.25a2.5 2.5 0 0 0-1.75-4.29c-.13 0-.25 0-.39.04l-1.63-3.25c.48-.45.77-1.08.77-1.79a2.5 2.5 0 0 0-5 0c0 .71.29 1.34.76 1.79L8.64 9.54c-.14-.04-.26-.04-.39-.04a2.5 2.5 0 0 0-1.75 4.29l-1.61 3.25C4.76 17 4.63 17 4.5 17a2.5 2.5 0 0 0 0 5A2.5 2.5 0 0 0 7 19.5c0-.7-.29-1.34-.76-1.79l1.62-3.25c.14.04.26.04.39.04s.25 0 .39-.04l1.63 3.25c-.47.45-.77 1.09-.77 1.79a2.5 2.5 0 0 0 5 0A2.5 2.5 0 0 0 12 17c-.13 0-.26 0-.39.04L10 13.79c.46-.45.75-1.08.75-1.79s-.29-1.34-.75-1.79l1.61-3.25c.13.04.26.04.39.04s.26 0 .39-.04L14 10.21c-.45.45-.75 1.09-.75 1.79a2.5 2.5 0 0 0 2.5 2.5c.13 0 .25 0 .39-.04l1.63 3.25c-.47.45-.77 1.09-.77 1.79a2.5 2.5 0 0 0 5 0a2.5 2.5 0 0 0-2.5-2.5Z" />
                                            </svg>
                                        </span>
                                        <p class="title-text">
                                            Metodologias
                                        </p>
                                        {{-- <p class="percent">
                                           <svg width="20" height="20" fill="currentColor" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1408 1216q0 26-19 45t-45 19h-896q-26 0-45-19t-19-45 19-45l448-448q19-19 45-19t45 19l448 448q19 19 19 45z">
                                                </path>
                                            </svg> 20%
                                        </p> --}}
                                    </div>
                                    <div class="data">
                                        <p id="textMetodologia" style="text-align: center">
                                            0
                                        </p>

                                        <div class="range">
                                            <div class="fill" id="rangeMetodologia"
                                                style="background-color: #FC6B3D;width:0%">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-2">

                                <div class="card-new">
                                    <div class="title">
                                        <span style="background-color: #FD5B79">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                viewBox="0 0 24 24">
                                                <path fill="#ffffff"
                                                    d="M8 16h2V8H8v8Zm4 0l6-4l-6-4v8Zm0 6q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Zm0-2q3.35 0 5.675-2.325T20 12q0-3.35-2.325-5.675T12 4Q8.65 4 6.325 6.325T4 12q0 3.35 2.325 5.675T12 20Zm0-8Z" />
                                            </svg>
                                        </span>
                                        <p class="title-text">
                                            Proyectos Iniciados
                                        </p>
                                        {{-- <p class="percent">
                                           <svg width="20" height="20" fill="currentColor" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1408 1216q0 26-19 45t-45 19h-896q-26 0-45-19t-19-45 19-45l448-448q19-19 45-19t45 19l448 448q19 19 19 45z">
                                                </path>
                                            </svg> 20%
                                        </p> --}}
                                    </div>
                                    <div class="data">
                                        <p id="textProyectoIni" style="text-align: center">
                                            0
                                        </p>

                                        <div class="range">
                                            <div class="fill" id="proyectoIni"
                                                style="background-color: #FD5B79;width:0%">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-2">

                                <div class="card-new">
                                    <div class="title">
                                        <span style="background-color: #5B98FD">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 100 100">
                                                <path fill="#fcfcfc"
                                                    d="M50 0a3.5 3.5 0 0 0-3.5 3.5V93h-9.57a3.5 3.5 0 0 0-3.5 3.5a3.5 3.5 0 0 0 3.5 3.5h25a3.5 3.5 0 0 0 3.5-3.5a3.5 3.5 0 0 0-3.5-3.5H53.5V47h43a3.5 3.5 0 0 0 3.5-3.5v-40A3.5 3.5 0 0 0 96.5 0h-46a3.5 3.5 0 0 0-.254.01A3.5 3.5 0 0 0 50 0zm13.8 7h9.8v7.43h9.8V7H93v7.43h-9.6v9.799H93v9.8h-9.6V40h-9.8v-5.97h-9.8V40H54v-5.97h9.8v-9.801H54v-9.8h9.8V7zm0 7.43v9.799h9.8v-9.8h-9.8zm9.8 9.799v9.8h9.8v-9.8h-9.8z"
                                                    color="#fcfcfc" />
                                            </svg>
                                        </span>
                                        <p class="title-text">
                                            Proyectos Finalizados
                                        </p>
                                        {{-- <p class="percent">
                                           <svg width="20" height="20" fill="currentColor" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1408 1216q0 26-19 45t-45 19h-896q-26 0-45-19t-19-45 19-45l448-448q19-19 45-19t45 19l448 448q19 19 19 45z">
                                                </path>
                                            </svg> 20%
                                        </p> --}}
                                    </div>
                                    <div class="data">
                                        <p id="textProyectoFina" style="text-align: center">
                                            0
                                        </p>

                                        <div class="range">
                                            <div class="fill" id="proyectoFin"
                                                style="background-color: #5B98FD; width:0%">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow mb-4 mt-3">
                <div class="card-body">
                    <div class="table-responsive" style="overflow-x:inherit!important;">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="descripcion">Proyecto</label>
                                    <div class="input-group">
                                        <select name="proyecto_id" id="proyecto_id"
                                            class=" form-control form-select  select">
                                            <option value="">Seleccione..</option>
                                            @foreach ($proyectos as $proyecto)
                                                <option value={{ $proyecto->id }}>{{ $proyecto->descripcion }}</option>
                                            @endforeach
                                        </select>
                                        @error('proyecto_id')
                                            <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row mt-4">
                            <ul class="nav nav-tabs d-none" id="myTabs">
                                <li class="nav-item " style="">
                                    <a class="nav-link active border" id="tab1" data-bs-toggle="tab"
                                        href="#content1">% Proyectos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link border" id="tab2" data-bs-toggle="tab" href="#content2">%
                                        Fases</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link border" id="tab3" data-bs-toggle="tab" href="#content3">%
                                        Indicadores</a>
                                </li>
                            </ul>

                            <div class="tab-content mt-2" id="contentTabs">
                                <div class="tab-pane fade show active" id="content1">
                                    <div class="row" id="graficoProyecto">


                                    </div>


                                </div>
                                <div class="tab-pane fade" id="content2">
                                    <div class="row" id="graficoFases">


                                    </div>
                                </div>
                                <div class="tab-pane fade" id="content3">
                                    <div class="row" id="graficoIndicadores"></div>
                                </div>
                            </div>
                        </div>
                        <div id="divFinal"></div>

                    </div>
                </div>
            </div>
        </div>



    </div>
    </div>
    @push('scripts-indicadores')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>


        <script src="{{ asset('js/reportes.js') }}" type="module"></script>
    @endpush
@endsection
