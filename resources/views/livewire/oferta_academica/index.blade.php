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
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                           xmlns="http://www.w3.org/2000/svg">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                           </path>
                        </svg>
                     </a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page"><a href="#">Convocatoria</a></li>
                  {{-- <li class="breadcrumb-item active" aria-current="page">Oferta Académica</li> --}}
               </ol>
            </nav>
            <div class="d-flex justify-content-between w-100 flex-wrap">
               <div class="mb-3 mb-lg-0">
                  <h1 class="h4">Oferta Académica</h1>
               </div>
               <div>
                  {{-- <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal6" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3.5 19L2 17.5L9.5 10l4 4l1.675-1.9l-5.6-5.175L3.5 13L2 11.5L9.5 4l7.1 6.525L20.6 6L22 7.4l-3.95 4.45L22 15.5L20.5 17l-3.85-3.55L13.5 17l-4-4Z"/></svg>Crear Eje --}}
                  </a>
               </div>
            </div>
         </div>
         <div class="row">
            @foreach ($areas as $area)
               <div class="col-12 col-sm-6 col-xl-6 mb-4">
                  <a href="/oferta-academica/{{ $area->id }}">
                     <div class="cards">
                        <div class="card border-0 shadow">
                           <div class="card-body">
                              <div class="row d-block d-xl-flex align-items-center">
                                 <div
                                    class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                                       <img src="/assets/img/imct/{{ $area->ruta_image }}">
                                    </div>
                                    <div class="d-sm-none">
                                       <h2 class="h5">Area</h2>
                                       <h3 class="fw-extrabold mb-1">{{ $area->name }}</h3>
                                    </div>
                                 </div>
                                 <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                       <h2 class="h6 text-gray-400 mb-0">Area</h2>
                                       <h3 class="fw-extrabold mb-2">{{ $area->name }}</h3>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </a>
               </div>
            @endforeach
         </div>

      </div>
   </div>
@endsection
