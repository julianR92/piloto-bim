import { initTable, getData, notifications, notyfError} from "./general.js";
const doc = document;

doc.addEventListener("DOMContentLoaded", function (e) {
    let dataTable = $("#myTable");
    let columnas = [
        {
            field: "id",
            align: "left",
        },
        {
            formatter: nombres,
        },
        {
            formatter: telefonos,
        },
        {
            field: "instagram",
            align: "left",
        },
        {
            formatter: estado,
        },
        {
            formatter: botones,
        },
    ];

    function botones(value, row, index) {
        return [
            '<button type="button" class="btn btn-success btn-sm d-inline-flex align-items-center editarData mx-1" data-id="' +
                row.id +
                '" title="editar cliente"><svg class="editarData" data-id="' +
                row.id +
                '" width="16" height="16" viewBox="0 0 24 24"><path class="editarData" data-id="' +
                row.id +
                '" fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg></button> ',
            '<button type="button" class="btn btn-danger btn-sm d-inline-flex align-items-center eliminarData mx-1" data-id="' +
                row.id +
                '" title="eliminar cliente" ><svg width="16" class="eliminarData" data-id="' +
                row.id +
                '" height="16" viewBox="0 0 24 24"><path class="eliminarData" data-id="' +
                row.id +
                '" fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg></button>',
            '<button type="button" class="btn btn-info btn-sm d-inline-flex align-items-center addAbono mx-1" data-nombre="' +
                row.nombres +
                " " +
                row.apellidos +
                '" data-id="' +
                row.id +
                '" title="Agregar Abono"><svg class="addAbono"  data-nombre="' +
                row.nombres +
                " " +
                row.apellidos +
                '" data-id="' +
                row.id +
                '"  xmlns="http://www.w3.org/2000/svg" width="16"  height="16" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><path class="addAbono" data-id="' +
                row.id +
                '"  data-nombre="' +
                row.nombres +
                " " +
                row.apellidos +
                '" d="M17.414 10.414C18 9.828 18 8.886 18 7c0-1.886 0-2.828-.586-3.414m0 6.828C16.828 11 15.886 11 14 11h-4c-1.886 0-2.828 0-3.414-.586m10.828 0Zm0-6.828C16.828 3 15.886 3 14 3h-4c-1.886 0-2.828 0-3.414.586m10.828 0Zm-10.828 0C6 4.172 6 5.114 6 7c0 1.886 0 2.828.586 3.414m0-6.828Zm0 6.828ZM13 7a1 1 0 1 1-2 0a1 1 0 0 1 2 0Z"/><path  data-nombre="' +
                row.nombres +
                " " +
                row.apellidos +
                '" class="addAbono" data-id="' +
                row.id +
                '" stroke-linecap="round" d="M18 6a3 3 0 0 1-3-3m3 5a3 3 0 0 0-3 3M6 6a3 3 0 0 0 3-3M6 8a3 3 0 0 1 3 3m-4 9.388h2.26c1.01 0 2.033.106 3.016.308a14.85 14.85 0 0 0 5.33.118c.868-.14 1.72-.355 2.492-.727c.696-.337 1.549-.81 2.122-1.341c.572-.53 1.168-1.397 1.59-2.075c.364-.582.188-1.295-.386-1.728a1.887 1.887 0 0 0-2.22 0l-1.807 1.365c-.7.53-1.465 1.017-2.376 1.162c-.11.017-.225.033-.345.047m0 0a8.176 8.176 0 0 1-.11.012m.11-.012a.998.998 0 0 0 .427-.24a1.492 1.492 0 0 0 .126-2.134a1.9 1.9 0 0 0-.45-.367c-2.797-1.669-7.15-.398-9.779 1.467m9.676 1.274a.524.524 0 0 1-.11.012m0 0a9.274 9.274 0 0 1-1.814.004"/><rect class="addAbono"  data-nombre="' +
                row.nombres +
                " " +
                row.apellidos +
                '" data-id="' +
                row.id +
                '" width="3" height="8" x="2" y="14" rx="1.5"/></g></svg></button>',
                
            '<button type="button" class="btn btn-gray-200 btn-sm d-inline-flex align-items-center viewAbonos" data-nombre="'+row.nombres +' '+row.apellidos+'" data-id="'+row.id+'" title="Ver Abono"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="viewAbonos"  data-nombre="'+row.nombres +' '+row.apellidos+'" data-id="'+row.id+'"><g fill="none" fill-rule="evenodd"><path class="viewAbonos"  data-nombre="'+row.nombres +' '+row.apellidos+'" data-id="'+row.id+'" d="M24 0v24H0V0h24ZM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018Zm.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01l-.184-.092Z" /><path class="viewAbonos"   data-nombre="'+row.nombres +' '+row.apellidos+'" data-id="'+row.id+'" fill="#ff99ca" d="M11.5 3a4.502 4.502 0 0 1 4.336 3.292l.052.205l1.87-.467a1 1 0 0 1 1.233.84L19 7v1.81a6.517 6.517 0 0 1 1.364 1.882l.138.308H21a1 1 0 0 1 .993.883L22 12v3a1 1 0 0 1-.445.832l-.108.062l-1.168.585a6.525 6.525 0 0 1-2.02 2.325l-.259.174V20a1 1 0 0 1-.883.993L17 21h-3a1 1 0 0 1-.993-.883L13 20h-1a1 1 0 0 1-.883.993L11 21H8a1 1 0 0 1-.993-.883L7 20v-1.022a6.508 6.508 0 0 1-2.854-4.101a3.002 3.002 0 0 1-2.14-2.693L2 12v-.5a1 1 0 0 1 1.993-.117L4 11.5v.5c0 .148.032.289.09.415a6.504 6.504 0 0 1 2.938-4.411A4.5 4.5 0 0 1 11.5 3Zm4.5 8a1 1 0 1 0 0 2a1 1 0 0 0 0-2Zm-4.5-6a2.5 2.5 0 0 0-2.478 2.169A6.52 6.52 0 0 1 10.5 7h3.377l.07-.017A2.5 2.5 0 0 0 11.5 5Z"/></g></svg></button>'
            
        ].join("");
    }
    function nombres(value, row, index) {
        return `${row.nombres} ${row.apellidos}`;
    }
    function telefonos(value, row, index) {
        return `${row.telefono}-${row.whatsapp ? row.whatsapp : ""}`;
    }
    function estado(value, row, index) {
        if (row.estado) {
            return [
                '<button class="button-activo btnEstado" data-id="' +
                    row.id +
                    '">Activo</button>',
            ].join("");
        } else {
            return [
                '<button class="button-inactivo btnEstado" data-id="' +
                    row.id +
                    '">Inactivo</button>',
            ].join("");
        }
    }   

    let $myForm = doc.getElementById("myForm");
    let pristine = new Pristine($myForm);
    $myForm.addEventListener("submit", (e) => {
        e.preventDefault();
        let valid = pristine.validate();
        if (valid) {
            let datos = getData(e.target);
            axios
                .post("/clientes", datos)
                .then(function (response) {
                    if (response.data.success) {
                        let myModalEl = document.getElementById("modalSignIn");
                        let modal = bootstrap.Modal.getInstance(myModalEl);
                        modal.hide();
                        $myForm.reset();
                        notifications(
                            "Proceso exitoso!",
                            response.data.message,
                            "success"
                        );
                        setTimeout(() => {
                            //  console.log(response.data.datos);
                            initTable(dataTable, columnas, response.data.datos);
                        }, 2000);
                        document.getElementById("id").value = "";
                    } else {
                        response.data.errors.forEach((el) => {
                            notyfError.open({
                                type: "error",
                                message: el,
                                duration: 8000,
                            });
                        });
                    }
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        }
    });

    let $myformAbonos = doc.getElementById("myFormModal");
    let pristineAbono = new Pristine($myformAbonos);

    $myformAbonos.addEventListener("submit", (e) => {
      e.preventDefault();
      let table = document.getElementById("myTableAbono").getElementsByTagName("tbody")[0];
      let rowLength = table.rows.length;
      let arr = [];
      if (rowLength == 0) {
        notyfError.open({
          type: "error",
          message: "Debes ingresar al menos un abono",
          duration: 5000,
      });
      return;
      }
      let valid = pristineAbono.validate();
      if (valid) {
        for (var i = 0; i < rowLength; i += 1) {
          var row = table.rows[i];
          arr[i] = {
              id: row.cells[0].dataset.tb,
              valor: row.cells[1].dataset.va,
              medio_pago_id: row.cells[2].dataset.medio,
              cuenta_pago_id: row.cells[3].dataset.cuenta,
              fecha_pago: row.cells[4].dataset.fecha,
              referencia_pago: row.cells[5].dataset.referencia,
              observaciones: row.cells[6].dataset.observaciones,
          };
      }
      let datos = getData(e.target);
      datos.abonos = arr;     
          
          axios
              .post("/clientes-abonos", datos)
              .then(function (response) {
                // console.log(response);
                  if (response.data.success) {
                      let myModalEl = document.getElementById("modalAbono");
                      let modal = bootstrap.Modal.getInstance(myModalEl);
                      modal.hide();
                      $myformAbonos.reset();
                      notifications(
                          "Proceso exitoso!",
                          response.data.message,
                          "success"
                      );
                      setTimeout(() => {
                          //  console.log(response.data.datos);
                          initTable(dataTable, columnas, response.data.datos);
                      }, 2000);
                      document.getElementById("cliente_id").value = "";
                  } else {
                      response.data.errors.forEach((el) => {
                          notyfError.open({
                              type: "error",
                              message: el,
                              duration: 8000,
                          });
                      });
                  }
              })
              .catch(function (error) {
                  console.log(error.response);
              });
      }
  });

   
    document.addEventListener("click", (e) => {
        //    console.log(e.target);
        if (e.target.matches(".editarData")) {
            axios
                .get(`/edit/clientes/${e.target.dataset.id}`)
                .then(function (response) {
                    let myModalEl = new bootstrap.Modal(
                        document.getElementById("modalSignIn"),
                        {
                            keyboard: false,
                        }
                    );
                    myModalEl.show();
                    document.querySelector(".titulo-modal").textContent =
                        "Editar Cliente";
                    document.querySelector(".btnModal").textContent =
                        "Actualizar Cliente";
                    document.getElementById("documento").value =
                        response.data.data.documento;
                    document.getElementById("nombres").value =
                        response.data.data.nombres;
                    document.getElementById("apellidos").value =
                        response.data.data.apellidos;
                    document.getElementById("telefono").value =
                        response.data.data.telefono;
                    document.getElementById("fecha_nacimiento").value =
                        response.data.data.fecha_nacimiento;
                    document.getElementById("whatsapp").value =
                        response.data.data.whatsapp;
                    document.getElementById("instagram").value =
                        response.data.data.instagram;
                    document.getElementById("direccion").value =
                        response.data.data.direccion;
                    document.getElementById("observacion").value =
                        response.data.data.observacion;
                    document.getElementById("calificacion_id").value =
                        response.data.data.calificacion_id;
                    document.getElementById("id").value = response.data.data.id;
                })
                .catch(function (error) {});
        }

        if (e.target.matches(".eliminarData")) {
            Swal.fire({
                title: "¿Esta seguro de eliminar este registro?",
                text: "Se Eliminara este registro de la base de datos",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, confirmar!",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete(`/delete/cliente/${e.target.dataset.id}`)
                        .then(function (response) {
                            notifications(
                                "Proceso exitoso!",
                                response.data.message,
                                "success"
                            );
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        })
                        .catch(function (error) {
                            alert(error);
                        });
                }
            });
        }

        if (e.target.matches(".btn-modal") || e.target.matches(".btn-cerrar")) {
            $myForm.reset();
            pristine.reset();
            document.querySelector(".titulo-modal").textContent =
                "Crear cliente";
            document.querySelector(".btnModal").textContent = "Crear";
            document.getElementById("id").value = "";
            
        }

        if (e.target.matches(".btnEstado")) {
            Swal.fire({
                title: "¿Esta seguro de cambiar el estado del cliente?",
                text: "Se activara o desactivara el cliente",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, confirmar!",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .get(`/activate/cliente/${e.target.dataset.id}`)
                        .then(function (response) {
                            notifications(
                                "Proceso exitoso!",
                                response.data.message,
                                "success"
                            );
                            setTimeout(() => {
                                //  location.reload();
                                initTable(
                                    dataTable,
                                    columnas,
                                    response.data.datos
                                );
                            }, 2000);
                        })
                        .catch(function (error) {});
                }
            });
        }
        if (e.target.matches(".addAbono")) {
            var myModalAbo = new bootstrap.Modal(
                document.getElementById("modalAbono"),
                {}
            );
            myModalAbo.show();
            document.getElementById("nombre_abono").value =
                e.target.dataset.nombre;
            document.getElementById("cliente_id").value = e.target.dataset.id;
            document.getElementById("valor").value = '';
           document.getElementById("medio_pago_id").value = '';
           document.getElementById("myTableAbono").getElementsByTagName("tbody")[0].innerHTML = '';
        }
        if (e.target.matches("#addAbonoTable")) {
            let valor_abono = document.getElementById("valor").value;
            let medio_pago = document.getElementById("medio_pago_id");
            let medio_pago_value =  medio_pago.options[medio_pago.selectedIndex].text;          
            let cuenta_pago = document.getElementById("cuenta_pago_id");

            let cuenta_pago_value = (cuenta_pago.value)?cuenta_pago.options[cuenta_pago.selectedIndex].text: '';          
            let fecha_pago = document.getElementById("fecha_pago").value;
            let referencia_pago = document.getElementById("referencia_pago").value;
            let observaciones = document.getElementById("observaciones").value;
            let table = document.getElementById("myTableAbono");
            var tbodyRowCount = table.tBodies[0].rows.length;
            var id_table = 1 + tbodyRowCount;

            let valor_boletas = new Intl.NumberFormat("es-CO").format(
                valor_abono
            );
            console.log(medio_pago.value);

            if (valor_abono.length == 0) {
                notyfError.open({
                    type: "error",
                    message: "Debes ingresar el valor de un abono",
                    duration: 5000,
                });
                return;
            }
            if (medio_pago.value.length == 0) {
                notyfError.open({
                    type: "error",
                    message: "Debes ingresar un medio de pago",
                    duration: 5000,
                });
                return;
            }
            if (cuenta_pago.value.length == 0) {
                notyfError.open({
                    type: "error",
                    message: "Debes ingresar una cuenta",
                    duration: 5000,
                });
                return;
            }
            if (fecha_pago.length == 0) {
                notyfError.open({
                    type: "error",
                    message: "Debes ingresar un la fecha de pago",
                    duration: 5000,
                });
                return;
            }
            if (medio_pago.value == 2 && referencia_pago.length == 0) {
                notyfError.open({
                    type: "error",
                    message: "Debes ingresar la referencia de pago",
                    duration: 5000,
                });
                return;
            }

            if (valor_abono.startsWith("0")) {
                valor_abono = "0";
            }
            if (medio_pago.value.startsWith("0")) {
                medio_pago = "0";
            }

            document
                .getElementById("myTableAbono")
                .getElementsByTagName("tbody")[0]
                .insertRow(-1).innerHTML = `<tr id="abonos_${id_table}">
        <td data-tb="${id_table}" id="row_${id_table}">
           ${id_table}
        </td>
        <td data-va="${valor_abono}">
           $${valor_boletas}
        </td>   
        <td data-medio="${medio_pago.value}">
        ${medio_pago_value}
        </td>        
        <td data-cuenta="${cuenta_pago.value}">
        ${cuenta_pago_value}
        </td>        
        <td data-fecha="${fecha_pago}">
        ${fecha_pago}
        </td>        
        <td data-referencia="${referencia_pago}">
        ${referencia_pago? referencia_pago: 'SIN REFERENCIA'}
        </td>        
        <td data-observaciones="${observaciones}" class="d-none">
        ${observaciones}
        </td>        
        <td>
           <div class="row">
              <div class="col">
              <div class="btn-group" role="group" aria-label="Basic example">              
                 <a data-row="this" class="btn btn-danger btn-xs btn-sm col text-white eliminarFila">
                    Eliminar
                 </a>
                 </div>
              </div>
           </div>
        </td>
     </tr>`;
     document.getElementById("valor").value = '';
     document.getElementById("medio_pago_id").value = '';
     document.getElementById("cuenta_pago_id").innerHTML = '';
     document.getElementById("fecha_pago").value = '';
     document.getElementById("referencia_pago").value = '';
     document.getElementById("referencia_pago").readOnly = true;
     document.getElementById("observaciones").value = '';
        
        }

        if(e.target.matches('.eliminarFila')){          
          Swal.fire({
            title: 'ESTAS SEGURO DE QUITAR ESTE ABONO?',
            text: "Este abono no se asignara al cliente",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3772FF',
            cancelButtonColor: '#A80521',
            confirmButtonText: 'Si, eliminar'
          }).then((result) => {
            if (result.isConfirmed) {            
            let tr = e.target.parentNode.parentNode.parentNode.parentNode.parentNode; 
            tr.parentNode.removeChild(tr)
              return; 
            }
          })
         
        }

        if(e.target.matches('.viewAbonos')){
            let customer = e.target.dataset.nombre;
            axios
                .get(`/clientes-abonos/view/${e.target.dataset.id}`)
                .then(function (response) {
                    document.getElementById('tbodyView').innerHTML= '';
                    if(response.data.success){
                        document.getElementById('cliente_abono').value = customer
                    let myModalEl = new bootstrap.Modal(
                        document.getElementById("modalViewAbono"),
                        {
                            keyboard: false,
                        }

                    );
                    
                    
                    let bodyTable = ``;
                    response.data.datos.forEach(el=>{
                        let valor_transformado = new Intl.NumberFormat("es-CO").format(
                            el.valor
                        );
                        // let fecha = new Date(el.fecha_pago);
                      
                        bodyTable += `
                        <tr>
                        <td>
                        ${el.id}
                        </td>
                        <td>
                        💲${valor_transformado}
                        </td>
                        <td>
                        ${el.medio_pago}
                        </td>
                        <td>
                        ${el.estado}
                        </td>
                        <td>
                        ${el.verificado ? 'Verficado ✔️': 'No Verficado⛔'}
                        </td>
                        <td>
                        📅${el.fecha_pago || 'sin fecha' }
                        </td>
                        <td class="text-center">
                        <a href="/download/comprobante/${el.id}" class="btnComprobante" title="Descargar comprobante">
                        <button type="button" class="btn btn-info btnComprobante btn-xs" data-id="${el.id}" titlle="descargar comprobante">
                        <svg xmlns="http://www.w3.org/2000/svg" class="btnComprobante" data-id="${el.id}" width="16" height="16" viewBox="0 0 24 24"><path class="btnComprobante" data-id="${el.id}" fill="currentColor" d="M12 15.575q-.2 0-.375-.062T11.3 15.3l-3.6-3.6q-.275-.275-.275-.7t.275-.7q.275-.275.713-.287t.712.262L11 12.15V5q0-.425.288-.713T12 4q.425 0 .713.288T13 5v7.15l1.875-1.875q.275-.275.713-.263t.712.288q.275.275.275.7t-.275.7l-3.6 3.6q-.15.15-.325.213t-.375.062ZM6 20q-.825 0-1.413-.588T4 18v-2q0-.425.288-.713T5 15q.425 0 .713.288T6 16v2h12v-2q0-.425.288-.713T19 15q.425 0 .713.288T20 16v2q0 .825-.588 1.413T18 20H6Z"/></svg>
                        </button>
                        </a>  
                        </td>
                       
                         
                        </tr>
                        `
                        
                    
                        
                      });
                     
                      document.getElementById('tbodyView').insertAdjacentHTML('afterbegin',bodyTable);
                        myModalEl.show();
                    }else{
                        document.getElementById('cliente_abono').value = customer
                    let myModalEl = new bootstrap.Modal(
                        document.getElementById("modalViewAbono"),
                        {
                            keyboard: false,
                        }
                    );

                    let bodyTable = ``;
                    bodyTable = `
                    <tr>
                    <td colspan="7" class="text-center">
                    <p style="font-weight:bold;">No tiene abonos disponibles ⛔</p>
                    </td>
                    </tr>
                    `
                    document.getElementById('tbodyView').insertAdjacentHTML('afterbegin',bodyTable);
                    myModalEl.show();


                    }
                   
                })
                .catch(function (error) {});

        }

        if(e.target.matches('.btnComprobante')){
            // e.preventDefault();
                     
        }
        
    });


    document.addEventListener("change",(e)=>{
        if (e.target.matches("#medio_pago_id")) {
            
         let medioPago = document.getElementById('medio_pago_id').value;         
          if(medioPago == 2){
            document.getElementById('referencia_pago').readOnly  = false;            
          }else{
            document.getElementById('referencia_pago').readOnly  = true;          
          }

          axios
                .get(`/cuentas/clientes/${medioPago}`)
                .then(function (response) {   
                    const $selectCuenta = document.getElementById('cuenta_pago_id'),
                    $fragment = document.createDocumentFragment();
                    $selectCuenta.innerHTML = '';
                    response.data.data.forEach(el=>{
                        const $option = document.createElement('option');
                        $option.textContent = el.entidad;
                        $option.value = el.id;
                        $fragment.appendChild($option);
                      });
                      $selectCuenta.appendChild($fragment);

                                  
                   
                })
                .catch(function (error) {});

        }

        if(e.target.matches('#referencia_pago')){
            let referencia_pago = e.target.value;
            axios
                .get(`/validate/referencia/${referencia_pago}`)
                .then(function (response) {   
                    if(response.data.success) {
                        notyfError.open({
                            type: "error",
                            message: `Referencia #${referencia_pago} ya se encuentra registrada`,
                            duration: 5000,
                        });
                        document.getElementById('referencia_pago').value = ''
                        return;

                    }

                                  
                   
                })
                .catch(function (error) {});

        }

    })
    
    
    // document.querySelectorAll(".eliminarFila").addEventListener('click', () => eliminarFila(fila));
});
 function eliminarFila(fila) {  
    
      Swal.fire({
        title: 'ESTAS SEGURO DE ELIMINAR ESTE REGISTRO?',
        text: "Este cambio es irreversible",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3772FF',
        cancelButtonColor: '#A80521',
        confirmButtonText: 'Si, eliminar'
      }).then((result) => {
        if (result.isConfirmed) {
          fila.closest("tr").remove();
          return;  
         
        }
      })
      
      
    
    }


