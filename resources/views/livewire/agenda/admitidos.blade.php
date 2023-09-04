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
                     <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                           d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                     </svg>
                  </a>
               </li>
               <li class="breadcrumb-item"><a href="/admitidos/{{$area->id}}">Inscripciones</a></li>
               @isset($admitidos[0])
               <li class="breadcrumb-item active" aria-current="page">PROGRAMA  {{($admitidos[0]->programa)? ($admitidos[0]->programa):''}} </li>
               @endisset
               <li class="breadcrumb-item active" aria-current="page">SIN RESULTADOS</li>
            </ol>
         </nav>
         <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
               @isset($admitidos[0])
               <h1 class="h4">ADMITIDOS DE {{($admitidos[0]->programa)? ($admitidos[0]->programa):''}} {{($admitidos[0]->grupo)? ($admitidos[0]->grupo):''}} {{($admitidos[0]->colectivo)? ($admitidos[0]->colectivo):''}} {{($admitidos[0]->instrumento)? ($admitidos[0]->instrumento):''}}</h1>
               @endisset
            </div>
            <div>
               {{-- <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal7" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="#888888" d="M12 5q.425 0 .713-.288Q13 4.425 13 4t-.287-.713Q12.425 3 12 3t-.712.287Q11 3.575 11 4t.288.712Q11.575 5 12 5ZM5 21q-.825 0-1.413-.587Q3 19.825 3 19V5q0-.825.587-1.413Q4.175 3 5 3h4.175q.275-.875 1.075-1.438Q11.05 1 12 1q1 0 1.788.562q.787.563 1.062 1.438H19q.825 0 1.413.587Q21 4.175 21 5v14q0 .825-.587 1.413Q19.825 21 19 21Zm0-2h14V5h-2v1q0 .825-.587 1.412Q15.825 8 15 8H9q-.825 0-1.412-.588Q7 6.825 7 6V5H5v14Z"/></svg>Crear Programa
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
               <table class="table table-centered table-nowrap mb-0 rounded" id="myTableInscrip" data-toggle="table"
                  data-search="true" data-pagination="true" data-page-size="5" data-show-export="true">
                  <thead class="thead-light">
                     <tr>
                        <th data-field="id" data-sortable="true" class="border-0 rounded-start">#</th>
                        <th data-field="programa" class="border-0">Programa</th>
                        <th data-field="grupo" class="border-0">Grupo</th>                        
                        <th data-field="nombres" class="border-0">Nombres</th>
                        <th data-field="documento" class="border-0">Documento</th>
                        <th data-field="estado" class="border-0">Estado</th>

                     </tr>
                  </thead>
                  <tbody id="tbodyEje">
                     @foreach ($admitidos as $datos)
                        <tr>

                           <td>{{ $datos->id }}</td>
                           <td>{{ $datos->programa }}</td>
                           <td>{{ $datos->grupo }}</td>                           
                           <td>{{ $datos->nombre }} {{ $datos->apellidos }}</td>
                           <td>{{ $datos->identificacion }}</td>
                           <td><span class="text-info">APROBADO <svg width="24" height="24" viewBox="0 0 24 24"><path fill="#0fd726" d="m23 12l-2.44-2.78l.34-3.68l-3.61-.82l-1.89-3.18L12 3L8.6 1.54L6.71 4.72l-3.61.81l.34 3.68L1 12l2.44 2.78l-.34 3.69l3.61.82l1.89 3.18L12 21l3.4 1.46l1.89-3.18l3.61-.82l-.34-3.68L23 12m-13 5l-4-4l1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8Z"/></svg></span>                     

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
      
      <script>
         document.addEventListener('click', (e) => {
            if (e.target.matches('#btnExportar')) {
               let data = @json($data_export);
               let area = @json($area);  
                      
                
               filename = `REPORTE-${data[0].programa}-${data[0].grupo}-${data[0].vigencia}.xlsx`;
               var ws = XLSX.utils.json_to_sheet(data);
               var wb = XLSX.utils.book_new();
               XLSX.utils.book_append_sheet(wb, ws, "People");
               XLSX.writeFile(wb, filename);
            }
         });
      </script>
   @endpush
@endsection
