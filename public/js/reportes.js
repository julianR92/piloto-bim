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
            let profesional = document.getElementById("profesional");
            let fecha_inicial = document.getElementById("fecha_inicial");
            let fecha_fin = document.getElementById("fecha_fin");
            let table = document.getElementById("myTableWeekly");
            let profesionalMessage = document.getElementById("mensajeProfesional");
            
            document.getElementById("tbodyView").innerHTML = "";
            if (profesional.value == "") {
                Swal.fire(
                    "Atencion!",
                    "Debe seleccionar un profesional",
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
                profesional: profesional.value,
                fecha_inicial: fecha_inicial.value,
                fecha_fin: fecha_fin.value,
            };
            axios
                .post("/reportes-comision/query", datos)
                .then(function (response) {
                    if (response.data.success) {
                        let bodyTable = ``;
                        let total = 0;
                        response.data.data.forEach((el, index) => {
                            let tipo_servicio = "Unico";
                            if (el.porcentaje == "50%") {
                                tipo_servicio = "Compartido";
                            }
                            total += parseInt(el.comision)

                            const fecha = new Date(el.created_at);
                            // Obtener el año, el mes y el día de la fecha
                            const year = fecha.getFullYear();
                            const month = String(fecha.getMonth() + 1).padStart(
                                2,
                                "0"
                            ); 
                            // Sumamos 1 al mes ya que en JavaScript los meses van de 0 a 11
                            const day = String(fecha.getDate()).padStart(
                                2,
                                "0"
                            );
                            // Formatear la fecha en el formato deseado (YYYY-MM-DD)
                            const fechaFormateada = `${year}-${month}-${day}`;

                            bodyTable += `
                        <tr>
                        <td>
                        ${index+1}
                        </td>
                        <td>
                         <b>Fecha:</b> ${fechaFormateada}
                        </td>
                        <td>
                        ${el.nombres} ${el.apellidos}
                        </td>
                        <td>
                        ${el.talla}
                        </td>
                        <td>
                        ${el.servicio}
                        </td>
                        <td>
                        $${money(el.comision)}
                        </td>
                        <td>
                        ${tipo_servicio}
                        </td>
                        </tr> `;
                        });
                        profesionalMessage.innerText = `${response.data.profesional.nombres} ${response.data.profesional.apellidos} # ${response.data.data.length} servicios 💇 realizados`
                        profesionalMessage.classList.remove('d-none');
                        document
                            .getElementById("tbodyView")
                            .insertAdjacentHTML("afterbegin", bodyTable);
                        table.classList.remove("d-none");
                        document.querySelector('.divValorGanado').classList.remove("d-none");
                        document.querySelector('.divSalida').classList.remove("d-none");
                        document.getElementById('total_cuenta').innerText=`$${money(total)}`
                        fecha_fin.value = "";
                        profesional.value = "";
                        fecha_inicial.value = "";
                        
                    } else {
                        Swal.fire(
                            "Atencion!",
                            "No hay resultados para esta busqueda",
                            "warning"
                        );
                        table.classList.add("d-none");
                        document.getElementById("tbodyView").innerHTML = "";
                        fecha_fin.value = "";
                        profesional.value = "";
                        fecha_inicial.value = "";
                        document.querySelector('.divValorGanado').classList.add("d-none");
                        profesionalMessage.classList.add('d-none');
                        document.getElementById('total_cuenta').innerText=null
                        document.querySelector('.divSalida').classList.add("d-none");
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
