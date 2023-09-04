@extends('layouts.main')

@section('content')
   <style>

   </style>

   <div>
      {{-- Be like water. --}}
      <div class="py-4">
         <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
             <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                 <li class="breadcrumb-item">
                     <a href="#">
                         <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                     </a>
                 </li>
                 <li class="breadcrumb-item"><a href="/admitidos">Admitidos</a></li>
                 <li class="breadcrumb-item active" aria-current="page">ADMITIDOS {{$area->name}}</li>
             </ol>
         </nav>
         <div class="d-flex justify-content-between w-100 flex-wrap">
             <div class="mb-3 mb-lg-0">
                 <h1 class="h4">OFERTA DE {{$area->name}} </h1>
                 <h4 class="h5">Convocatoria: {{$programas[0]->vigencia}}</h4>
             </div>   
             <div>
                 {{-- <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal-prue" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                     <svg width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="m226.8 61.2l-32-32a3.9 3.9 0 0 0-5.6 0l-96 96A3.6 3.6 0 0 0 92 128v32a4 4 0 0 0 4 4h32a3.6 3.6 0 0 0 2.8-1.2l96-96a3.9 3.9 0 0 0 0-5.6ZM126.3 156H100v-26.3l68-68L194.3 88ZM200 82.3L173.7 56L192 37.7L218.3 64Zm20 37.7v88a12 12 0 0 1-12 12H48a12 12 0 0 1-12-12V48a12 12 0 0 1 12-12h88a4 4 0 0 1 0 8H48a4 4 0 0 0-4 4v160a4 4 0 0 0 4 4h160a4 4 0 0 0 4-4v-88a4 4 0 0 1 8 0Z"/></svg>Crear Prueba
                     </a> --}}
             </div>         
         </div>
     </div>


      <div class="card border-0 shadow mb-4">
         <div class="card-body">
            <button type="button" id="btnExportar" class=" mb-4 btn btn-success d-inline-flex align-items-center text-white">
               Exportar
               <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M21.17 3.25q.33 0 .59.25q.24.24.24.58v15.84q0 .34-.24.58q-.26.25-.59.25H7.83q-.33 0-.59-.25q-.24-.24-.24-.58V17H2.83q-.33 0-.59-.24Q2 16.5 2 16.17V7.83q0-.33.24-.59Q2.5 7 2.83 7H7V4.08q0-.34.24-.58q.26-.25.59-.25M7 13.06l1.18 2.22h1.79L8 12.06l1.93-3.17H8.22L7.13 10.9l-.04.06l-.03.07q-.26-.53-.56-1.07q-.25-.53-.53-1.07H4.16l1.89 3.19L4 15.28h1.78m8.1 4.22V17H8.25v2.5m5.63-3.75v-3.12H12v3.12m1.88-4.37V8.25H12v3.13M13.88 7V4.5H8.25V7m12.5 12.5V17h-5.62v2.5m5.62-3.75v-3.12h-5.62v3.12m5.62-4.37V8.25h-5.62v3.13M20.75 7V4.5h-5.62V7Z"/></svg>
            </button>

            <div class="table-responsive">
               <table class="table table-centered table-nowrap mb-0 rounded" id="myTablePrue" data-toggle="table" data-search="true" data-pagination="true" data-page-size="5" >
                  <thead class="thead-light">
                      <tr>
                          <th data-field="id" data-sortable="true" class="border-0 rounded-start">#</th>
                          <th data-field="programa" class="border-0">Programa</th>                           
                          <th data-field="codigo" class="border-0">Codigo</th>                          
                          <th data-field="evaluados" class="border-0">Ver Evaluados</th>
                          
                         
                      </tr>
                  </thead>
                  <tbody id="tbodyEje">
                      @foreach($programas as $programa)
                       <tr>
                          <td>{{$programa->oferta_id}}</td>
                          <td>{{$programa->programa}}-{{$programa->grupo}} {{($programa->colectivo)?$programa->colectivo:''}} {{($programa->instrumento)?$programa->instrumento:''}}</td>                         
                          <td>{{$programa->codigo}}</td>
                          <td><a href="/admitidos/oferta/{{$programa->oferta_id}}/{{$programa->area_id}}"><button class="btn btn-outline-success" type="button">Ver Admitidos</button></a></td>
                         
                         
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
               <a href="/inscripciones" class="text-info me-3 float-end"><svg width="16" height="16"
                     viewBox="0 0 24 24">
                     <path fill="currentColor"
                        d="M3.97 12c0 4.41 3.62 8.03 8.03 8.03c4.41 0 8.03-3.62 8.03-8.03c0-4.41-3.62-8.03-8.03-8.03c-4.41 0-8.03 3.62-8.03 8.03M2 12C2 6.46 6.46 2 12 2s10 4.46 10 10s-4.46 10-10 10S2 17.54 2 12m8.46-1V8L6.5 12l3.96 4v-3h7.04v-2" />
                  </svg>Atras</a>
            </div>
         </div>
      </div>
    
   </div>
   @push('admitidos-js')
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.1/xlsx.full.min.js"></script>
      <script src="{{asset('js/inscripciones.js')}}" type="module"></script>
      <script>
         document.addEventListener('click', (e) => {
            if (e.target.matches('#btnExportar')) {
               let data = @json($data_export);
               let area = @json($area);         

               filename = `REPORTE-ADMITIDOS-${area.name}-${data[0].vigencia}.xlsx`;
               var ws = XLSX.utils.json_to_sheet(data);
               var wb = XLSX.utils.book_new();
               XLSX.utils.book_append_sheet(wb, ws, "datos");
               XLSX.writeFile(wb, filename);
            }
         });
      </script>
   @endpush
@endsection
