@extends('layouts.main')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
        integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
    <style>
        .bi-plus::before {
            font-size: 1.5rem;
            color: #2361ce !important;
            font-weight: 800 !important;
        }

        .bi-dash::before {
            font-size: 1.5rem;
            color: #2361ce !important;
            font-weight: 800 !important;
        }

        /* estilos files multiple */

        #file-container {
            margin-bottom: 10px;
        }

        .file-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .file-name {
            margin-right: 10px;
        }

        .remove-btn {
            cursor: pointer;
            color: red;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .tdTiny {
            width: 150px;
            /* Ancho fijo */
            word-wrap: break-word;
            /* Hacer salto de línea */
            max-width: 100%;
            /* Evitar que el contenido desborde el ancho fijo */
            white-space: normal;
            /* Hacer que el texto se ajuste automáticamente */
        }
    </style>
    <div>
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
                        <li class="breadcrumb-item"><a href="#">Modulo de Seguimiento </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Gestion de Proyectos</li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between w-100 flex-wrap">
                    <div class="mb-3 mb-lg-0">
                        <h1 class="h4">Gestion de Proyectos</h1>
                    </div>
                    {{-- <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 14 14"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><rect width="3.5" height="3.5" x=".5" y="10" rx=".5"/><rect width="3.5" height="3.5" x="10" y="10" rx=".5"/><rect width="4" height="4" x="5" y=".5" rx=".5"/><path d="M4 12h6M5.09 4.29L2.5 10m6.41-5.71L11.5 10"/></g></svg>Crear Metodologia
                </a>
            </div>          --}}
                </div>
            </div>

            <div class="card border-0 shadow mb-4" id="cardBody">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-nowrap mb-0 rounded" id="myTable" data-toggle="table"
                            data-detail-view="true" data-detail-formatter="detailFormatter" data-search="true"
                            data-pagination="true" data-page-size="10">
                            <thead class="thead-light">
                                <tr>

                                    <th data-field="id" data-sortable="true" class="border-0 text-center rounded-start">#
                                    </th>
                                    <th data-field="proyecto" class="border-0 text-center">Proyecto</th>
                                    <th data-field="metodologia" class="border-0 text-center">Metodologia</th>


                                </tr>
                            </thead>
                            <tbody id="">


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>





            {{-- <div class="container mt-3">
        
        <div class="card">
            <h5 class="card-header">
                <a class="collapsed d-block" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-chevron-down pull-right"></i>
                    Collapsible Group Item #1
                </a>
            </h5>
            <div class="collapse" id="collapseExample">
                <div class="card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon
                    officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                    wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                    Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan
                    excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt
                    you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
            </div>
        </div>
    </div> --}}
            {{-- MODAL --}}
            {{-- <div class="modal fade" id="modalSignIn" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo-modal">Crear Proyecto</h2>
                    <form action="#" method="" id="myForm">                        
                       
                        <div class="form-group mb-2">
                            <label for="nombre_fase">Nombre Metodologia *</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path d="M5 15.5L7.5 20h-5L5 15.5M9 19h12v-2H9v2zM5 9.5L7.5 14h-5L5 9.5M9 13h12v-2H9v2zM5 3.5L7.5 8h-5L5 3.5M9 7h12V5H9v2z" fill="currentColor"/></svg>
                                </span>
                                <input name="descripcion" type="text" class="form-control border-gray-300" placeholder="Ej: METODOLOGIA MIXTA" id="descripcion" required data-pristine-required-message="Campo Requerido" maxlength="100" onkeyup="aMayusculas(this.value,this.id)" onkeypress="return NumDoc(event)" autofocus>
                                @error('descripcion') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div>   
                        
                        <div class="form-group mb-2">
                            <label for="estado">Estado*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="estado" id="estado" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido">
                                    <option value="">Seleccione..</option>
                                    <option value="1">ACTIVO</option>
                                    <option value="2">INACTIVO</option>
                                </select>
                                @error('estado') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                                       
                        
                        <!-- End of Form -->                        
                        <div class="d-grid mt-3">
                            <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-info btnModal">Crear Metodologia</button>
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>    
        --}}
            <div class="container mt-5">
                <div class="row">

                </div>
            </div>

        </div>
    </div>
    @push('scripts-seguimiento')
        {{-- <script src="{{ asset('js/seguimiento.js') }}" type="module"></script> --}}

        <script>
            function detailFormatter(idx, row) {
                console.log(row.seguimientos)
                var html = []
                let body = '';
                body += `<div class="container-fluid mt-2">
         <p class="text-center h6 text-bold" style="font-weight:bold">Detalle de Seguimiento</p>
         <table class="table">
        <thead>
       <tr>
         <th class="text-center">Fase</th>
         <th class="text-center">Hito</th>
         <th class="text-center">Indicador</th>
         <th class="text-center">Porcentaje</th>
         <th class="text-center">Detalle</th>
       </tr>
     </thead>
     <tbody>      
    `;
                row.seguimientos.forEach((el, index, array) => {
                    body += `<tr data-bs-toggle="collapse" href="#detail-${index+1}-${idx}" role="button" id="tr-${index+1}-${idx}" aria-expanded="false" aria-controls="detail-${index+1}-${idx}">
         <td class="text-center">${el.fase.nombre_fase}</td>
         <td class="text-center">${el.hito.nombre_hito}</td>
         <td class="text-center">${el.indicador.nombre_indicador}</td>
         <td class="text-center">%${el.indicador.valor}</td>
         <td>
                   <button class="btn btn-sm class" id="btn-${index+1}-${idx}" onclick="toggleSVG(this.id)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#00cc63" d="m12 16.175l3.9-3.875q.275-.275.688-.288t.712.288q.275.275.275.7t-.275.7l-4.6 4.6q-.15.15-.325.213t-.375.062q-.2 0-.375-.063T11.3 18.3l-4.6-4.6q-.275-.275-.288-.687T6.7 12.3q.275-.275.7-.275t.7.275l3.9 3.875Zm0-6L15.9 6.3q.275-.275.688-.287t.712.287q.275.275.275.7t-.275.7l-4.6 4.6q-.15.15-.325.213t-.375.062q-.2 0-.375-.062T11.3 12.3L6.7 7.7q-.275-.275-.288-.688T6.7 6.3q.275-.275.7-.275t.7.275l3.9 3.875Z"/></svg></button>
         </td>
         
         </tr>
         <tr class="collapse" id="detail-${index+1}-${idx}">
                 <td colspan="5" style="padding-left:0!important; padding-right:0!important;">`;

                    if (el.estado) {

                        body += `

                    <div class="ocultar">
                     <p style="font-weigth:bold;"><b>Registrar Actuacion</b></p>

                     <form action="#" method="" class="formActuacion" id="myForm-${index+1}-${idx}"  enctype="multipart/form-data">   
                         <div class="row">                   
                        <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="nombre_fase">Observacion *</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M4 20q-.825 0-1.413-.588T2 18V6q0-.825.588-1.413T4 4h16q.825 0 1.413.588T22 6v12q0 .825-.588 1.413T20 20H4Zm0-2h16V6H4v12Zm0 0V6v12Zm2-1h12q.425 0 .713-.288T19 16q0-.425-.288-.713T18 15H6q-.425 0-.713.288T5 16q0 .425.288.713T6 17Zm0-4h12q.425 0 .713-.288T19 12q0-.425-.288-.713T18 11H6q-.425 0-.713.288T5 12q0 .425.288.713T6 13Zm0-4h8q.425 0 .713-.288T15 8q0-.425-.288-.713T14 7H6q-.425 0-.713.288T5 8q0 .425.288.713T6 9Z"/></svg>
                                    
                                </span>
                                <textarea rows="4" name="descripcion" type="text" class="form-control border-gray-300" placeholder="Ej: para cumplir este indicador se relizara..." id="descripcion" required  maxlength="100" onkeyup="aMayusculas(this.value,this.id)" onkeypress="return NumDoc(event)" autofocus style="resize:none;"></textarea>
                                
                            </div> 
                        </div>  
                     </div> 
                        
                     <div class="col-md-6">
                     <div id="file-container" class="mb-3">
                  <label for="files" class="form-label">Selecciona archivos:</label>
                  <input type="file" name="files[]" accept="application/pdf" id="files" class="form-control inputFiles" multiple>
                </div>
        
                <div id="file-list-myForm-${index+1}-${idx}"></div>
              </div>
              
              <div class="col-md-4">
                <div class="form-group mb-4">
                        <label for="permiso">Porcentaje de Avance *<small>(Equivale en %)</small></label>
                        <div class="input-group">
                            <span class="input-group-text border-gray-300" id="basic-addon3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M17.503 4.498L4.499 17.503a1.411 1.411 0 0 0 1.996 1.996L19.499 6.495a1.412 1.412 0 0 0-1.996-1.997zM7.002 5a2 2 0 1 0-.004 4a2 2 0 0 0 .004-4zm10 10a2 2 0 1 0-.004 4a2 2 0 0 0 .004-4z"/></svg>
                            </span>
                            <input name="valor" type="number" class="form-control border-gray-300" placeholder="Ej: 70" id="valor" required  onkeypress="return Numeros(event)" maxlength="3" minlength="1" max="100">
                                
                    </div> 
                </div>
                
            </div>
                                       
                        
                        <!-- End of Form -->                        
                    <div class="d-grid mt-3">
                            <input type="hidden" name="seguimiento_id" id="seguimiento_id" value="${el.id}">
                            <input type="hidden" name="proyecto_id" id="proyecto_id" value="${row.id}">
                            <button type="submit" class="btn btn-info btnForm">Agregar Actuacion</button>
                        </div>
                    </div>  
                   </form> 
                </div>`;
                    }

                    body += `
                 <p style="font-weigth:bold; text-align:center" class="mt-4"><b>Trazabilidad</b></p>
                 <div class="table-responsive">
                  <table class="table table-bordered" style="border-collapse: collapse; width:100%">
                    <thead>
                    <th class="text-center" style="white-space:normal!important; widht:150px!important; word-wrap: break-word!important;">Id</th>    
                    <th class="text-center" style="white-space:normal!important; widht:150px!important; word-wrap: break-word!important;">Observacion</th>    
                    <th class="text-center" style="white-space:normal!important; widht:150px!important; word-wrap: break-word!important;">% Avance</th>    
                    <th class="text-center" style="white-space:normal!important; widht:150px!important; word-wrap: break-word!important;">% Evaluado</th>    
                    <th class="text-center" style="white-space:normal!important; widht:150px!important; word-wrap: break-word!important;">Fecha</th>    
                    <th class="text-center" style="white-space:normal!important; widht:150px!important; word-wrap: break-word!important;">Estado</th>    
                    <th class="text-center" style="white-space:normal!important; widht:150px!important; word-wrap: break-word!important;">Documentos</th>    
                    </thead>

                    <tbody>`;
                    row.seguimientos[index].detalles.forEach((el, idxx) => {

                        body +=
                            `
                            <tr>
                            <td class="text-center" style="white-space:normal!important; widht:150px!important; word-wrap: break-word!important;">${idxx+1}</td>
                            <td class="text-center" style="white-space:normal!important; widht:150px!important; word-wrap: break-word!important;">${el.observacion}</td>
                            <td class="text-center" style="white-space:normal!important; widht:150px!important; word-wrap: break-word!important;">%${el.porcentaje_avance}</td>
                            <td class="text-center" style="white-space:normal!important; widht:150px!important; word-wrap: break-word!important;">${el.porcentaje_real || 'SIN EVALUAR'}</td>
                            <td class="text-center" style="white-space:normal!important; widht:150px!important; word-wrap: break-word!important;">${el.fecha_registro}</td>
                            <td class="text-center" style="white-space:normal!important; widht:150px!important; word-wrap: break-word!important;">${el.estado ? 'EVALUADO ✅': 'SIN EVALUAR ❌'}</td>
                            <td class="text-center" style="white-space:normal!important; widht:150px!important; word-wrap: break-word!important;"> <ul>`
                        row.seguimientos[index].detalles[idxx].documentos.forEach((elm, idxx) => {
                            body +=
                                `
                               
                                 <a href="/${elm.ruta}" target="_blank"><li><p style="font-size:10px;">${elm.nombre_doc}</p></li></a>`
                        });
                        body += `
                                </ul>

                                    
                                    
                                    
                                
                            </td>
                            </tr>`
                    });
                    body += `

                    
                    </tbody>
                    
                    
                </table>
                </div>

                 </td>
           </tr>
         `
                });
                body += `</tbody>
    </table>
    </div>
    `
                return [body].join("");

            }

            function toggleSVG(id) {
                var button = document.getElementById(id);
                var svg = button.querySelector('svg');
                var tr = document.getElementById(`tr-${id.split('-')[1]}-${id.split('-')[2]}`);


                if (tr.classList.contains('collapsed')) {

                    svg.innerHTML =
                        '<path fill="#00cc63" d="m12 16.175l3.9-3.875q.275-.275.688-.288t.712.288q.275.275.275.7t-.275.7l-4.6 4.6q-.15.15-.325.213t-.375.062q-.2 0-.375-.063T11.3 18.3l-4.6-4.6q-.275-.275-.288-.687T6.7 12.3q.275-.275.7-.275t.7.275l3.9 3.875Zm0-6L15.9 6.3q.275-.275.688-.287t.712.287q.275.275.275.7t-.275.7l-4.6 4.6q-.15.15-.325.213t-.375.062q-.2 0-.375-.062T11.3 12.3L6.7 7.7q-.275-.275-.288-.688T6.7 6.3q.275-.275.7-.275t.7.275l3.9 3.875Z"/>';
                } else {
                    svg.innerHTML =
                        '<path fill="#00cc63" d="M12 13.825L8.1 17.7q-.275.275-.688.288T6.7 17.7q-.275-.275-.275-.7t.275-.7l4.6-4.6q.15-.15.325-.213t.375-.062q.2 0 .375.062t.325.213l4.6 4.6q.275.275.288.688t-.288.712q-.275.275-.7.275t-.7-.275L12 13.825Zm0-6L8.1 11.7q-.275.275-.688.288T6.7 11.7q-.275-.275-.275-.7t.275-.7l4.6-4.6q.15-.15.325-.212T12 5.425q.2 0 .375.063t.325.212l4.6 4.6q.275.275.288.688t-.288.712q-.275.275-.7.275t-.7-.275L12 7.825Z"/>'; // 

                }
            }


            document.addEventListener('DOMContentLoaded', function() {
                var fileListContainer;
                var fileInput
                let filesForm = {};

                dataTable = $('#myTable');
                columnas = [{
                        field: "id",
                        align: 'left'
                    },
                    {
                        field: "descripcion",
                        align: 'left'
                    },
                    {
                        formatter: metodologia,
                    },

                ];

                function metodologia(value, row, index) {
                    return [
                        `${row.metodologia.descripcion}`
                    ].join('')

                }
                //cargo los datos
                loadData();

                document.addEventListener('change', (e) => {

                    if (e.target.matches(".inputFiles")) {
                        fileInput = e.target;
                        const formId = getFormId(fileInput);
                        console.log(filesForm)
                        if (formId) {
                            fileListContainer = findFileListContainer(formId);
                            filesForm[formId] = filesForm[formId] || [];

                            handleFileSelect(e, fileListContainer, filesForm, formId);

                        }
                    }




                })



                function handleFileSelect(event, fileListContainer, filesForm, formId) {
                    const files = event.target.files;

                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        filesForm[formId].push(file);
                        addFileItem(file, fileListContainer, filesForm, formId);

                    }

                    console.log(filesForm);


                    fileInput.value = '';



                }

                function getFormId(inputElement) {
                    return inputElement.closest('.formActuacion')?.id || null;
                }

                function addFileItem(file, fileListContainer, filesForm, formId) {
                    if (file.size <= 5 * 1024 * 1024) {
                        const fileItem = document.createElement('div');
                        fileItem.classList.add('file-item');

                        const fileName = document.createElement('span');
                        fileName.classList.add('file-name');
                        fileName.textContent = file.name;

                        const removeBtn = document.createElement('span');
                        removeBtn.classList.add('remove-btn', 'ms-2');
                        removeBtn.innerHTML = '&times; Eliminar';
                        removeBtn.addEventListener('click', (e) => removeFileItem(formId, fileItem, file, e, ));

                        fileItem.appendChild(fileName);
                        fileItem.appendChild(removeBtn);

                        fileListContainer.appendChild(fileItem);
                    } else {
                        Swal.fire({
                            title: "Atencion!",
                            text: "El archivo excede el límite de tamaño de 5 MB. Por favor, seleccione un archivo más pequeño.",
                            icon: "warning"
                        });

                    }
                }



                function removeFileItem(formId, fileItem, file, e) {

                    event.target.parentElement.parentElement.removeChild(fileItem);

                    // Eliminar el archivo del array de archivos seleccionados específico para el formulario
                    const archivosSeleccionados = filesForm[formId] || [];
                    const index = archivosSeleccionados.indexOf(file);
                    if (index !== -1) {
                        archivosSeleccionados.splice(index, 1);
                    }
                    console.log(filesForm)


                }

                function findFileListContainer(formId) {
                    return document.getElementById(`file-list-${formId}`);
                }

                function getData(form) {
                    var formData = new FormData(form);
                    let data = {};

                    if (form.id in filesForm) {
                        const filesForForm = filesForm[form.id];

                        for (let i = 0; i < filesForForm.length; i++) {
                            formData.append('documents[]', filesForForm[i], 'file' + i);
                        }

                        data.documentos = formData.getAll('documents[]');
                    }

                    // Convertir formData a un objeto plano
                    formData.forEach((value, key) => {
                        data[key] = value;
                    });

                    return data;
                }

                const notyfError = new Notyf({
                    position: {
                        x: 'right',
                        y: 'top',
                    },
                    types: [{
                            type: 'error',
                            background: '#FA5252',
                            icon: {
                                className: 'fas fa-times',
                                tagName: 'span',
                                color: '#fff'
                            },
                            dismissible: false,
                        }

                    ]

                });

                function loadData() {
                    document.querySelector('.loader').style.display = 'block';
                    document.querySelector('.loader-container').classList.remove('d-none');
                    axios.get(`/gestion-proyectos/loadData`)
                        .then(function(response) {
                            setTimeout(() => {
                                document.querySelector('.loader').style.display = 'none';
                                document.querySelector('.loader-container').classList.add('d-none');
                                var scrollTop = (document.documentElement.scrollTop || document.body
                                    .scrollTop);

                                if (scrollTop > 0) {
                                    window.scrollTo({
                                        top: 0,
                                        behavior: 'smooth'
                                    });
                                }

                                initTable(dataTable, columnas, response.data.datos);




                            }, 3000)




                        }).catch(function(error) {
                            document.querySelector('.loader').style.display = 'none';
                            document.querySelector('.loader-container').classList.add('d-none');
                            notyfError.open({
                                type: 'error',
                                message: 'Ocurrio un error al cargar los datos',
                                duration: 8000,
                            });

                        })
                }

                function notifications(titulo, texto, icono) {
                    Swal.fire({
                        title: titulo,
                        text: texto,
                        icon: icono,
                        toast: true,
                        timer: 2000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        position: 'top-right',
                    });

                }

                function initTable(dataTable, columnas, data) {

                    dataTable.bootstrapTable('destroy').bootstrapTable({

                        data: data,
                        columns: columnas,
                        search: true,
                        pagination: true,
                        sortable: true,
                        pageSize: 5

                    });
                }




                document.addEventListener('submit', (e) => {
                    if (e.target.matches('.formActuacion')) {
                        e.preventDefault();
                        Swal.fire({
                            title: '¿Esta seguro de realizar esta actuacion?',
                            text: "Se creara una ruta de seguimiento a este Item, revisa bien las observaciones y archivos que vas a subir",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, confirmar!',
                            cancelButtonText: 'Cancelar',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                let datos = getData(e.target);
                                console.log(datos);
                                axios.post('/gestion-proyectos', datos, {
                                        headers: {
                                            'Content-Type': 'multipart/form-data',
                                        }
                                    })
                                    .then(function(response) {
                                        if (response.data.success) {
                                            notifications('Proceso exitoso!', response.data
                                                .message,
                                                'success');
                                            loadData();


                                        } else {
                                            response.data.errors.forEach((el) => {
                                                notyfError.open({
                                                    type: 'error',
                                                    message: el,
                                                    duration: 8000,
                                                });
                                            })

                                        }
                                    }).catch(function(error) {
                                        notyfError.open({
                                            type: 'error',
                                            message: 'Ocurrio un error al realizar esta accion por favor intente mas tarde',
                                            duration: 8000,
                                        });
                                    });

                            }
                        })
                    }

                })

            });
        </script>
    @endpush
@endsection
