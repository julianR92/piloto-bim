import { initTable, getData, notifications, notyfError } from "./general.js";
const doc = document;

doc.addEventListener("DOMContentLoaded", function (e) {
    let profesional = document.getElementById("profesional_id");
    let cliente = document.getElementById("cliente_id");
    let talla = document.getElementById("talla_id");
    let servicio = document.getElementById("servicio_id");
    let descuento = document.getElementById("descuento_id");
    let fecha_inicial = document.getElementById("fecha_inicial");
    let fecha_fin = document.getElementById("fecha_fin");

    let table = document.getElementById("myTableWeekly");
    let profesionalMessage = document.getElementById("mensajeProfesional");
    localStorage.clear();
    $("#cliente_id").select2({
        width: "100%",
        placeholder: "Seleccione un cliente",
        allowClear: true
    });
    let dataTable = $("#myTable");

    let columnas = [
        {
           formatter:ID
         },
        {
            formatter: procedimiento,
        },
        {
            formatter: nombres,
        },
        {
            field: "servicio",
            align: "left",
        },
        {
            field: "talla",
            align: "left",
        },
        {
            formatter: profesionales,
        },
        {
            formatter: abono,
        },
        {
            formatter: valor,
        },       
        {
            field:'plan',
            align: "left",
        },       
    ];

    function nombres(value, row, index) {
        return `${row.nombres} ${row.apellidos}`;
    }
    function profesionales(value, row, index) {
         console.log(value, row, index);
       return [row.nombres_profesional +' '+ row.apellidos_profesional].join('')
    }
    function procedimiento(value, row, index) {
        const fecha = new Date(row.created_at);

        // Obtiene el año, mes y día de la fecha
        const año = fecha.getFullYear();
        const mes = String(fecha.getMonth() + 1).padStart(2, "0"); // Agrega un cero inicial si es necesario
        const dia = String(fecha.getDate()).padStart(2, "0"); // Agrega un cero inicial si es necesario

        // Crea la cadena formateada "yyyy-mm-dd"
        const fechaFormateada = `${año}-${mes}-${dia}`;

        return `${row.id} - ${fechaFormateada}`;
    }
    function abono(value, row, index) {        
        return ['$'+money(row.valor) +'  fecha: '+ row.fecha_pago].join('')
      
    }
    function valor(value, row, index) {        

        return ['$'+money(parseInt(row.valor_pagar))]
    }
    function ID(value, row, index) {        

        return index+1;
    }

    

    document.addEventListener("click", (e) => {
        if (e.target.matches(".btnBuscar")) {
            // document.getElementById("tbodyView").innerHTML = "";
            if (
                profesional.value == "" &&
                cliente.value == "" &&
                talla.value == "" &&
                servicio.value == "" &&
                descuento.value == "" &&
                fecha_inicial.value == "" &&
                fecha_fin.value == ""
            ) {
                Swal.fire(
                    "Atencion!",
                    "Todos los campos no pueden estar vacios",
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
                profesional: profesional.value ? profesional.value : "%",
                fecha_inicial: fecha_inicial.value
                    ? fecha_inicial.value
                    : "2019-01-01",
                fecha_fin: fecha_fin.value ? fecha_fin.value : "2050-12-31",
                cliente: cliente.value ? cliente.value : "%",
                servicio: servicio.value ? servicio.value : "%",
                talla: talla.value ? talla.value : "%",
                descuento: descuento.value ? descuento.value : "%",
            };
            axios
                .post("/reportes-procedimientos/query", datos)
                .then(function (response) {
                    if (response.data.success) {
                        document.getElementById('myTable').classList.remove('d-none')                        
                        document.querySelector('.divSalida').classList.remove('d-none')                        
                        console.log(response.data.datos);
                        initTable(dataTable,columnas,response.data.datos);

                       
                        // fecha_inicial.value = "";
                    } else {
                        Swal.fire(
                            "Atencion!",
                            "No hay resultados para esta busqueda",
                            "warning"
                        );
                        $('#cliente_id').val('').trigger('change'); 
                        dataTable.bootstrapTable('destroy')
                        document.getElementById('myTable').classList.add('d-none')                        
                        document.querySelector('.divSalida').classList.add('d-none') 
                        return;
                    }
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        }

        if (e.target.matches(".btnSalir")) {
            $('#cliente_id').val('').trigger('change'); 
            dataTable.bootstrapTable('destroy')
            document.getElementById('myTable').classList.add('d-none')                        
            document.querySelector('.divSalida').classList.add('d-none')
            profesional.value = "" 
            cliente.value = "" 
            talla.value = "" 
            servicio.value = "" 
            descuento.value = "" 
            fecha_inicial.value = "" 
            fecha_fin.value = "" 
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
