import { initTable, getData, notifications, notyfError } from "./general.js";
const doc = document;
let profesional_id = "";
let producto_id = "";
let cierre = 0;
doc.addEventListener("DOMContentLoaded", function (e) {
    localStorage.clear();
    let dataTable = $("#myTable");

    //

    document.addEventListener("click", (e) => {      

      

       

        if (e.target.matches(".btnBuscar")) {
        
            let fecha_inicial = document.getElementById("fecha_inicial");
            let fecha_fin = document.getElementById("fecha_fin");
            let table = document.getElementById("myTableWeekly");
            let tableAdicional = document.getElementById("tableAdicional");
            let tableServicios = document.getElementById("tableServicios");
            let profesionalMessage = document.getElementById("mensajeProfesional");
            let elementosHR = document.querySelectorAll('.linea-divisoria');
            
            document.getElementById("tbodyView").innerHTML = "";          
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
                fecha_inicial: fecha_inicial.value,
                fecha_fin: fecha_fin.value,
            };
            axios
                .post("/reporte-cierre/query", datos)
                .then(function (response) {

                   if (response.data.success) {
                        document.getElementById("tbodyView").innerHTML=null;
                        let bodyTable = ``;
                        let total = 0;
                        response.data.data.forEach((el, index) => {                           
                            total += parseInt(el.total)                          

                            bodyTable += `
                        <tr>
                        <td>
                        ${index+1}
                        </td>
                        <td>
                        <p class="fw-bold">${el.entidad}</p>                       
                        </td>
                        <td>
                        <p class="text-center fw-bold">${el.medio_pago}</p>
                        </td>                      
                        <td>
                        $${money(el.total)}
                        </td>
                        <td>
                        <p class="text-center fw-bold">${parseInt(el.cantidad)}</p>
                        </td>
                        </tr> `;
                        });
                        
                        document
                            .getElementById("tbodyView")
                            .insertAdjacentHTML("afterbegin", bodyTable);
                        table.classList.remove("d-none");
                        document.querySelector('.divValorGanado').classList.remove("d-none");
                        document.querySelector('.divSalida').classList.remove("d-none");
                        document.getElementById('total_cuenta').innerText=`$${money(total)}`
                        document.getElementById('label-abonos').innerText = 'ABONOS'
                         
                        // table 2_____________________________________________________________
                        document.getElementById("tbodyViewAdicional").innerHTML=null;
                        let bodyTable2 = ``;
                        let total2 = 0;
                        response.data.data2.forEach((el, index) => {                           
                            total2 += parseInt(el.total)                          

                            bodyTable2 += `
                        <tr>
                        <td>
                        ${index+1}
                        </td>
                        <td>
                        <p class="fw-bold">${el.entidad}</p>                       
                        </td>
                        <td>
                        <p class="text-center fw-bold">${el.medio_pago}</p>
                        </td>                      
                        <td>
                        $${money(el.total)}
                        </td>
                        <td>
                        <p class="text-center fw-bold">${parseInt(el.cantidad)}</p>
                        </td>
                        </tr> `;
                        });
                        
                        // profesionalMessage.innerText = `${response.data.profesional.nombres} ${response.data.profesional.apellidos} # ${response.data.data.length} servicios agrupados 💇 realizados`
                        // profesionalMessage.classList.remove('d-none');
                        document
                            .getElementById("tbodyViewAdicional")
                            .insertAdjacentHTML("afterbegin", bodyTable2);
                        tableAdicional.classList.remove("d-none");
                        document.querySelector('.divValorGanado2').classList.remove("d-none");
                        document.querySelector('.divSalida').classList.remove("d-none");
                        document.getElementById('total2_cuenta').innerText=`$${money(total2)}`
                        document.getElementById('label-procedimientos').innerText = 'PROCEDIMIENTOS'

                         // table 2_____________________________________________________________
                         document.getElementById("tbodyViewServicios").innerHTML=null;
                         let bodyTable3 = ``;
                         let total3 = 0;
                         response.data.data3.forEach((el, index) => {                           
                            total3 += parseInt(el.total)                          

                            bodyTable3 += `
                        <tr>
                        <td>
                        ${index+1}
                        </td>
                        <td>
                        <p class="fw-bold">${el.entidad}</p>                       
                        </td>
                        <td>
                        <p class="text-center fw-bold">${el.medio_pago}</p>
                        </td>                      
                        <td>
                        $${money(el.total)}
                        </td>
                        <td>
                        <p class="text-center fw-bold">${parseInt(el.cantidad)}</p>
                        </td>
                        </tr> `;
                        });
                        
                        
                         document
                             .getElementById("tbodyViewServicios")
                             .insertAdjacentHTML("afterbegin", bodyTable3);
                        tableServicios.classList.remove("d-none");
                         document.querySelector('.divValorGanado3').classList.remove("d-none");
                         document.querySelector('.divSalida').classList.remove("d-none");
                         document.querySelector('.linea-divisoria').classList.remove("d-none");
                         document.getElementById('total3_cuenta').innerText=`$${money(total3)}`
                         document.getElementById('label-servicios').innerText = 'SERVICIOS'
                 

                        //total

                        let superTotal = parseInt(total) + parseInt(total2) + parseInt(total3) 
                        document.getElementById('super_total').innerText=`$${money(superTotal)}`
                    profesionalMessage.innerText = ` 📅 Rango de : ${fecha_inicial.value} hasta: ${fecha_fin.value} `
                     profesionalMessage.classList.remove('d-none');
                     elementosHR.forEach(function(elemento) {
                        elemento.classList.remove('d-none');
                      });


                        fecha_fin.value = "";
                        fecha_inicial.value = "";
                        
                    } else {
                        Swal.fire(
                            "Atencion!",
                            "No hay resultados para esta busqueda",
                            "warning"
                        );
                        tableAdicional.classList.add("d-none");
                        table.classList.add("d-none");
                        document.getElementById("tbodyView").innerHTML = "";
                        document.getElementById("tbodyViewAdicional").innerHTML = "";
                        fecha_fin.value = "";                  
                        fecha_inicial.value = "";
                        document.querySelector('.divValorGanado').classList.add("d-none");
                        document.querySelector('.divValorGanado2').classList.add("d-none");
                        document.querySelector('.divValorGanado3').classList.add("d-none");
                        profesionalMessage.classList.add('d-none');
                        profesionalMessage.innerText=null;
                        document.getElementById('total_cuenta').innerText=null
                        document.getElementById('total2_cuenta').innerText=null
                        document.getElementById('total3_cuenta').innerText=null
                        document.querySelector('.divSalida').classList.add("d-none");
                        document.getElementById('super_total').innerText=null;
                        elementosHR.forEach(function(elemento) {
                            elemento.classList.add('d-none');
                          });
                        return;
                    }
                 
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        }
       
        if (e.target.matches(".btnSalir")) {         
            localStorage.clear();
            location.reload();
        }
       
    });

    function money(valor) {
        let valueConversion = new Intl.NumberFormat("es-CO").format(valor);
        return valueConversion;
    }

    document.querySelectorAll("#format").forEach((el) => {
        let valueConversion = new Intl.NumberFormat("es-CO").format(
            el.innerText
        );
        el.innerText = `$ ${valueConversion}`;
    });

   
});
