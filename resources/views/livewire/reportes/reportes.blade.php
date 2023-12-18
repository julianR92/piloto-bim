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
                            <div class="col-md-6 mb-5">
                                <div class="form-group">
                                    <label for="descripcion">Metodologias</label>
                                    <div class="input-group">
                                        <select name="metodologia_id" id="metodologia_id"
                                            class=" form-control form-select  select">
                                            <option value="">Seleccione..</option>
                                            @foreach ($metodologias as $metodo)
                                                <option value={{ $metodo->id }}>{{ $metodo->descripcion }}</option>
                                            @endforeach
                                        </select>
                                       
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="form-group">
                                    <label for="descripcion">Proyecto</label>
                                    <div class="input-group">
                                        <select name="proyecto_id" id="proyecto_id"
                                            class=" form-control form-select  select">
                                            
                                        </select>
                                       
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-4">

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
                            <div class="col-md-4">

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
                            <div class="col-md-4">

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
                           
                           
                            


                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow mb-4 mt-3">
                <div class="card-body">
                    <div class="table-responsive" style="overflow-x:inherit!important;">
                        
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
                                    <a class="nav-link border" id="tab4" data-bs-toggle="tab" href="#content4">%
                                        Hitos</a>
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
                                <div class="tab-pane fade" id="content4">
                                    <div class="row" id="graficoHitos">


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
