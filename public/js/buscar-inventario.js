import { initTable, getData, notifications, notyfError } from "./general.js";
const doc = document;
doc.addEventListener("DOMContentLoaded", function (e) {
    localStorage.clear();      
        

    document.addEventListener("click", (e) => {       
        
      
        if (e.target.matches(".btnBuscar")) {
            let profesional = document.getElementById("profesional");
            let producto = document.getElementById("producto");
            let fecha_inicial = document.getElementById("fecha_inicial");
            let fecha_fin = document.getElementById("fecha_fin");
            let tipo_transaccion = document.getElementById("tipo_transaccion");
            let table = document.getElementById("myTableWeekly");
            let porDefault = '%';
            document.getElementById('tbodyView').innerHTML = '';           
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
                profesional:profesional.value || porDefault,
                producto:producto.value || porDefault,
                tipo_transaccion:tipo_transaccion.value || porDefault,
                fecha_inicial: fecha_inicial.value,
                fecha_fin: fecha_fin.value,
            };
            
            axios.post("/producto-semana/buscar", datos)
                .then(function (response) {
                  if (response.data.data.length !=0) {
                    localStorage.setItem('queryData', JSON.stringify(response.data.data));
                    let backgroundColor='';
                    
                    
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
                        ${money(el.valor)}
                        </td>
                        <td>
                        ${el.nombres} ${el.apellidos}
                        </td                     
                                             
                         </tr>
                        `                       
                                           
                      });
                      document.getElementById('tbodyView').insertAdjacentHTML('afterbegin',bodyTable);
                      table.classList.remove('d-none');
                      document.querySelector('.divSalida').classList.remove('d-none');                     
                    
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
                    tipo_transaccion.value = "";
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
        
        if (e.target.matches(".btnSalir")) {
            localStorage.clear();
            location.reload();
        }
       
    });

    function money(valor){
        let valueConversion = new Intl.NumberFormat("es-CO").format(valor);
        return valueConversion;
    }

  

   
});
