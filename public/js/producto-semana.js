import { initTable, getData, notifications, notyfError } from "./general.js";
const doc = document;
let profesional_id = '';
let producto_id = '';
let cierre = 0;
doc.addEventListener("DOMContentLoaded", function (e) {
    localStorage.clear();
    let dataTable = $("#myTable");    
     
    let $myForm = doc.getElementById("myForm");
    let pristine = new Pristine($myForm);
    $myForm.addEventListener("submit", (e) => {
        e.preventDefault();
        let valid = pristine.validate();
        if (valid) {
            let datos = getData(e.target);
            axios
                .post("/producto-semana", datos)
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
                            location.reload();
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

    document.addEventListener("click", (e) => {
        if (e.target.matches(".editarData")) {
            axios
                .get(`/edit/producto-semana/${e.target.dataset.id}`)
                .then(function (response) {
                    let myModalEl = new bootstrap.Modal(
                        document.getElementById("modalSignIn"),
                        {
                            keyboard: false,
                        }
                    );
                    console.log(response.data.data);
                    myModalEl.show();
                    document.querySelector(".titulo-modal").textContent =
                        "Editar Inventario";
                    document.querySelector(".btnModal").textContent = "Editar Recarga";
                    document.getElementById("profesional_mo").value =
                        response.data.data.profesional_id;
                    document.getElementById("producto_mo").value =
                        response.data.data.producto_id;
                    document.getElementById("tipo_transaccion").value =
                        response.data.data.tipo_transaccion;
                    document.getElementById("fecha").value =
                        response.data.data.fecha;
                    document.getElementById("valor").value =
                        response.data.data.valor;
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
                        .delete(`/delete/producto-semana/${e.target.dataset.id}`)
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
                        .catch(function (error) {});
                }
            });
        }

        if (e.target.matches(".btn-modal") || e.target.matches(".btn-cerrar")) {
            $myForm.reset();
            pristine.reset();
            document.querySelector(".titulo-modal").textContent =
                "Recargar Inventario";
            document.querySelector(".btnModal").textContent = "Recargar";
            document.getElementById("id").value = "";
        }

        if (e.target.matches(".btnBuscar")) {
            let profesional = document.getElementById("profesional");
            let producto = document.getElementById("producto");
            let fecha_inicial = document.getElementById("fecha_inicial");
            let fecha_fin = document.getElementById("fecha_fin");
            let table = document.getElementById("myTableWeekly");
            document.getElementById('tbodyView').innerHTML = '';
            if (profesional.value == "") {
                Swal.fire(
                    "Atencion!",
                    "Debe seleccionar un profesional",
                    "warning"
                );
                return;
            }
            if (producto.value == "") {
                Swal.fire(
                    "Atencion!",
                    "Debe seleccionar un producto",
                    "warning"
                );
                return;
            }
            if (fecha_inicial.value == "") {
                Swal.fire(
                    "Atencion!",
                    "Debe seleccionar una fecha inicial",
                    "warning"
                );
                return;
            }
            if (fecha_fin.value == "") {
                Swal.fire(
                    "Atencion!",
                    "Debe seleccionar una fecha fin",
                    "warning"
                );
                return;
            }
            if (fecha_inicial.value > fecha_fin.value) {
                Swal.fire(
                    "Atencion!",
                    "La fecha inicial no puede ser mayor que la fecha final",
                    "warning"
                );
                fecha_fin.value = "";
                return;
            }

            let datos = {
                profesional:profesional.value,
                producto:producto.value,
                fecha_inicial: fecha_inicial.value,
                fecha_fin: fecha_fin.value,
            };
            axios.post("/producto-semana/query", datos)
                .then(function (response) {
                  if (response.data.data.length !=0) {
                    localStorage.setItem('queryData', JSON.stringify(response.data.data));
                    let cerrado = false;
                    let backgroundColor='';
                    let entradas = response.data.data.filter(elemento => elemento.tipo_transaccion === "CIERRE");
                    if(entradas.length>0){
                       cerrado = true;
                    }
                    
                    let bodyTable = ``;
                    response.data.data.forEach((el,index)=>{   
                        if(el.tipo_transaccion =="STOCK" || el.tipo_transaccion == "ENTRADA"){
                            backgroundColor = '#74FC55';
                        }else if(el.tipo_transaccion == "SALIDA"){
                            backgroundColor = '#F5463E';
                            
                        }else{
                            backgroundColor = '#3771F7';
                        }
                                                                                       
                        bodyTable += `
                        <tr>
                        <td>
                        ${index+1}
                        </td>
                        <td>
                        📅${el.fecha}
                        </td>
                        <td style="background-color:${backgroundColor}; font-weight:bold;">
                        ${el.tipo_transaccion}
                        </td>
                        <td>
                        ${el.nombre_producto}
                        </td>
                        <td>
                        ${el.valor}
                        </td>
                        <td>
                        ${el.nombres} ${el.apellidos}
                        </td>                      
                        <td class="text-center">                       
                        <button type="button" class="btn editarData btn-xs" data-id="${el.id}" title="Editar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="editarData" data-id="${el.id}"  width="24" height="24" viewBox="0 0 24 24"><path class="editarData" data-id="${el.id}" fill="#10cb30" d="M6 2c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h4v-1.9l10-10V8l-6-6H6m7 1.5L18.5 9H13V3.5m7.1 9.5c-.1 0-.3.1-.4.2l-1 1l2.1 2.1l1-1c.2-.2.2-.6 0-.8l-1.3-1.3c-.1-.1-.2-.2-.4-.2m-2 1.8L12 20.9V23h2.1l6.1-6.1l-2.1-2.1Z"/></svg>  </button>

                        <button type="button" class="btn eliminarData btn-xs" data-id="${el.id}" title="Editar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="eliminarData" data-id="${el.id}" width="24" height="24" viewBox="0 0 24 24"><path fill="#df0707" data-id="${el.id}" class="eliminarData" d="m9.4 16.5l2.6-2.6l2.6 2.6l1.4-1.4l-2.6-2.6L16 9.9l-1.4-1.4l-2.6 2.6l-2.6-2.6L8 9.9l2.6 2.6L8 15.1l1.4 1.4ZM7 21q-.825 0-1.413-.588T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.588 1.413T17 21H7Z"/></svg> </button>
                        
                        </td>                      
                         </tr>
                        `                       
                                           
                      });
                      document.getElementById('tbodyView').insertAdjacentHTML('afterbegin',bodyTable);
                      table.classList.remove('d-none');
                      if(cerrado){
                          document.querySelector('.divSalida').classList.remove('d-none');

                      }else{
                          document.querySelector('.divCalcular').classList.remove('d-none');
                      }
                    
                  }else{
                    Swal.fire(
                        "Atencion!",
                        "No hay resultados para esta busqueda",
                        "warning"
                    );
                    table.classList.add('d-none');
                    document.getElementById('tbodyView').innerHTML = '';
                    fecha_fin.value = "";
                    producto.value = "";
                    profesional.value = "";
                    fecha_inicial.value = "";
                    localStorage.clear();
                    localStorage.removeItem('queryData');

                    return;
                  }

                })
                .catch(function (error) {
                    console.log(error.response);
                });
        }
        if (e.target.matches(".btnCalcular")) {
            let queryData = JSON.parse(localStorage.getItem('queryData'));
            let suma = 0;
            let resta = 0;            
            document.querySelector('.divCalculos').innerHTML = '';
            for (var i = 0; i < queryData.length; i++) {
                if (queryData[i].tipo_transaccion =='STOCK' || queryData[i].tipo_transaccion =='ENTRADA') {
                    suma += queryData[i].valor;
                } else if (queryData[i].tipo_transaccion === 'SALIDA') {
                    resta += queryData[i].valor;
                }
                producto_id = queryData[i].producto_id
                profesional_id = queryData[i].profesional_id
            }           
            
          cierre = parseFloat(suma)-parseFloat(resta)
          let bodyCalculos = `
          <h3>Calculo de Inventario</h3>
          <div class="col-md-2">
              <h4>Entradas</h4>
              <p style="font-size:20px;">${money(suma)} <small>Grs</small></p>
          </div>
          <div class="col-md-2">
              <h4>Salidas</h4>
              <p style="font-size:20px;">${money(resta)} <small>Grs</small></p>
          </div>
          <div class="col-md-3">
              <h4>Cierre Estimado</h4>
              <p style="font-size:20px;font-weight:bold"><span style="background-color:gold">${money(cierre)} <small>Grs</small></span></mark></p>
          </div>
          <div class="col-md-2">
              <h4>Cierre Real</h4>
              <input name="cierre_real" type="text" class="form-control border-gray-300" placeholder="Ej: 2000" id="cierre_real"   onkeypress="return Numeros(event)" autofocus>
          </div>
          <div class="col-md-3 mt-4">
              <button type="button" class="btn btn-primary d-inline-flex align-items-center btnCierre mt-2 ms-2"><svg class="btnCierre" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path  class="btnCierre" fill="currentColor" d="m10.6 13.8l-2.15-2.15q-.275-.275-.7-.275t-.7.275q-.275.275-.275.7t.275.7L9.9 15.9q.3.3.7.3t.7-.3l5.65-5.65q.275-.275.275-.7t-.275-.7q-.275-.275-.7-.275t-.7.275L10.6 13.8ZM12 22q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Z"/></svg> Guardar </button>

              <button type="button" class="btn btn-gray-200 d-inline-flex align-items-center btnSalir mt-2"> Salir </button>
          </div>
          `
          document.querySelector('.divCalculos').insertAdjacentHTML('afterbegin',bodyCalculos);
            


        }
        if (e.target.matches(".btnSalir")) {
            localStorage.clear();
            location.reload();
        }
        if (e.target.matches(".btnCierre")) {
            let cierre_real  = document.getElementById("cierre_real");
            let tipo= '';
            if (cierre_real.value == "") {
                Swal.fire(
                    "Atencion!",
                    "Debe escribir el valor de cierre",
                    "warning"
                );
                return;
            }
            let sobrante_faltante = parseFloat(cierre)-parseFloat(cierre_real.value)
            if(sobrante_faltante > 0){
             tipo = 'FALTANTE'
            }else{
            tipo = 'SOBRANTE'
           }
            let datos = {
               1:{
                 profesional_id:profesional_id,
                 producto_id:producto_id,
                 tipo_transaccion:'CIERRE',
                 valor: parseFloat(cierre_real.value),
               },
               2:{
                 profesional_id:profesional_id,
                 producto_id:producto_id,
                 tipo_transaccion:tipo,
                 valor: Math.abs(sobrante_faltante),
               }
            }
            axios.post("/producto-semana/cierre", datos)
                .then(function (response) {
                    localStorage.clear();
                    localStorage.removeItem('queryData');
                    notifications(
                        "Proceso exitoso!",
                        response.data.message,
                        "success"
                    );
                    setTimeout(() => {
                        location.reload();
                    }, 2000)

                })
                .catch(function (error) {
                    console.log(error.response);
                });

            
        }
    });

    function money(valor){
        let valueConversion = new Intl.NumberFormat("es-CO").format(valor);
        return valueConversion;
    }

    document.querySelectorAll("#format").forEach((el) => {
        let valueConversion = new Intl.NumberFormat("es-CO").format(
            el.innerText
        );
        el.innerText = `$ ${valueConversion}`;
    });

    // $('.valor_boleteria').each(function () {
    //     var input = $(this).text();
    //    var valor_convertido =  new Intl.NumberFormat("es-CO").format(input);
    //    $(this).text('$'+valor_convertido);

    // });

    //   if(e.target.matches('.btnEstado')){

    //     Swal.fire({
    //         title: '¿Esta seguro de cambiar el estado del colectivo?',
    //         text: "Si se desactiva ya no sera visible en la creacion de oferta",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Si, confirmar!',
    //         cancelButtonText: 'Cancelar',
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             axios.get(`/activate/colectivos/${e.target.dataset.id}`).then(function(response){
    //                 notifications('Proceso exitoso!',response.data.message,'success');
    //                 setTimeout(()=>{
    //                  location.reload();
    //                 },2000)

    //            }).catch(function(error){
    //            })

    //         }
    //     })

    //   }
});
