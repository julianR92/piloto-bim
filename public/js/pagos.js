import { initTable, getData, notifications, notyfError } from "./general.js";
const doc = document;
const valorPrecioInput = document.getElementById("valor_precio");
const valorAbonoInput = document.getElementById("valor_abono");
const planesSelect = document.getElementById("planes_id");
const valorPagarInput = document.getElementById("valor_pagar");
const totalCuenta = document.getElementById("total_cuenta");

doc.addEventListener("DOMContentLoaded", function (e) {
    totalCuenta.innerText =  `$${0}`
    const autocompleteInput = document.getElementById("documento");
    const suggestions = document.getElementById("suggestions");
    const divTable = document.querySelector(".div-table");
   
    //escucha los eventos
    valorPrecioInput.addEventListener("change", calcularPrecioFinal);
    valorAbonoInput.addEventListener("change", calcularPrecioFinal);
    planesSelect.addEventListener("change", calcularPrecioFinal);

    autocompleteInput.addEventListener("input", function () {
        const searchText = this.value;
        if (searchText.length >= 5) {
            axios
                .get(`/procedimientos/search/cliente/${searchText}`)
                .then(function (response) {
                    // console.log(response.data.data);
                    if (response.data.data.length > 0) {
                        // Mostrar las sugerencias en una lista
                        suggestions.innerHTML = "";
                        response.data.data.forEach(function (item) {
                            const suggestionItem = document.createElement("a");
                            suggestionItem.href = "#";
                            suggestionItem.classList.add(
                                "list-group-item",
                                "list-group-item-action"
                            );
                            suggestionItem.innerText = `${item.documento} - ${item.apellidos} ${item.nombres}`;
                            suggestions.appendChild(suggestionItem);

                            // Manejar clic en una sugerencia
                            suggestionItem.addEventListener(
                                "click",
                                function () {
                                    autocompleteInput.value = item.documento;
                                    suggestions.innerHTML = "";
                                }
                            );
                        });
                    } else {
                        suggestions.innerHTML =
                            "<p class='text-center pt-2 fw-bold'>No se encontraron sugerencias ❌</p>";
                        setTimeout(() => {
                            suggestions.innerHTML = "";
                        }, 5000);
                    }
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        } else {
            suggestions.innerHTML = "";
        }
    });

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
            formatter: date,
        },
        {
            formatter: tipoServicio,
        },
        {
            formatter: formatMoney,
        },
        {
            formatter: botones,
        },
    ];

    function botones(value, row, index) {
        return [
            '<button type="button" class="btn btn-info d-inline-flex align-items-center goPayment mx-1" data-id="' +
                row.id +
                '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M13.3 20.275q-.3-.3-.3-.7t.3-.7L16.175 16H7q-.825 0-1.413-.588T5 14V5q0-.425.288-.713T6 4q.425 0 .713.288T7 5v9h9.175l-2.9-2.9q-.3-.3-.288-.7t.288-.7q.3-.3.7-.312t.7.287L19.3 14.3q.15.15.212.325t.063.375q0 .2-.063.375t-.212.325l-4.575 4.575q-.3.3-.712.3t-.713-.3Z"/></svg>Ir a Pagar</button> ',
        ].join("");
    }

    function formatMoney(value, row, index) {
        let valueConversion = new Intl.NumberFormat("es-CO").format(row.valor);
        return ["$" + valueConversion].join("");
    }
    function nombres(value, row, index) {
        return [row.nombres + " " + row.apellidos].join("");
    }
    function date(value, row, index) {
        return [row.fecha + "-" + row.hora].join("");
    }
    function tipoServicio(value, row, index) {
        return [row.tipo_servicio + "-" + row.servicio].join("");
    }

    let $myForm = doc.getElementById("myForm");
    let pristine = new Pristine($myForm);
    $myForm.addEventListener("submit", (e) => {
        e.preventDefault();
        let valid = pristine.validate();
        if (valid) {
            let datos = getData(e.target);
            console.log(datos);
            axios
                .post("/procedimientos", datos)
                .then(function (response) {
                    if (response.data.success) {
                        console.log('entre')
                        Swal.fire(
                            response.data.message,
                            `Valor Pagado: ${moneyFormat(response.data.valor)}`,
                            'success'
                          ) 
                          $myForm.reset();
                          $myForm.classList.add("d-none");
                          console.log('entre')
                          setTimeout(()=>{
                            location.reload();
                           },10000)


                        
                    } else {
                        console.log(response.data.errorMessage)
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
                .get(`/edit/productos/${e.target.dataset.id}`)
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
                        "Editar Productos";
                    document.querySelector(".btnModal").textContent = "Editar";
                    document.getElementById("nombre").value =
                        response.data.data.nombre;
                    document.getElementById("tipo").value =
                        response.data.data.tipo;
                    document.getElementById("presentacion").value =
                        response.data.data.presentacion;
                    document.getElementById("valor_unitario").value =
                        response.data.data.valor_unitario;
                    document.getElementById("id").value = response.data.data.id;
                })
                .catch(function (error) {});
        }

        if (e.target.matches(".btnClose")) {
            Swal.fire({
                title: "¿Esta seguro de parar esta transaccion?",
                text: "No se podra continuar con el pago",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, confirmar!",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    $myForm.reset();
                    $myForm.classList.add("d-none");
                }
            });
        }

        if (e.target.matches(".btn-modal") || e.target.matches(".btn-cerrar")) {
            $myForm.reset();
            pristine.reset();
            document.querySelector(".titulo-modal").textContent =
                "Crear Producto";
            document.querySelector(".btnModal").textContent = "Crear";
            document.getElementById("id").value = "";
        }

        if (e.target.matches(".btnSearch")) {
            if (
                autocompleteInput.value == "" ||
                autocompleteInput.value == null
            ) {
                notifications(
                    "Atencion!",
                    "Campo documento obligatorio",
                    "warning"
                );
                return;
            }

            axios
                .get(`/procedimientos/search/agenda/${autocompleteInput.value}`)
                .then(function (response) {
                    if (response.data.success) {
                        initTable(dataTable, columnas, response.data.datos);
                        divTable.classList.remove("d-none");
                        autocompleteInput.value = "";
                    } else {
                        notifications(
                            "Atencion!",
                            response.data.message,
                            "error"
                        );
                        divTable.classList.add("d-none");
                        dataTable.bootstrapTable("destroy");
                        return;
                    }
                })
                .catch(function (error) {});
        }
        if (e.target.matches(".goPayment")) {
            axios
                .get(`/procedimientos/payment/${e.target.dataset.id}`)
                .then(function (response) {
                    if (response.data.success) {
                        
                        document.getElementById(
                            "nombre"
                        ).value = `${response.data.data.nombres} ${response.data.data.apellidos}`;
                        document.getElementById("servicio_id").value =
                            response.data.data.servicio_id;
                        document.getElementById(
                            "abono_mostrar"
                        ).value = `${moneyFormat(response.data.data.valor)}`;
                        document.getElementById(
                            "valor_abono"
                        ).value = `${response.data.data.valor}`;
                        document.getElementById(
                            "abonos_id"
                        ).value = `${response.data.data.abono_id}`;
                        document.getElementById(
                            "cliente_id"
                        ).value = `${response.data.data.cliente_id}`;
                        document.getElementById(
                            "agenda_id"
                        ).value = `${response.data.data.id}`;
                        divTable.classList.add("d-none");
                        dataTable.bootstrapTable("destroy");
                        $myForm.classList.remove("d-none");
                        
                    }
                })
                .catch(function (error) {});
        }
    });

    document.addEventListener("change", (e) => {
        if (e.target.matches("#servicio_id")) {
            calcularPrecio();
            
        }
        if (e.target.matches("#talla_id")) {
            calcularPrecio();
            
        }
    });

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

function moneyFormat(value) {
    let valueConversion = new Intl.NumberFormat("es-CO").format(value);
    return valueConversion;
}


async function calcularPrecio() {
    let servicioValue = document.getElementById("servicio_id").value;
    let tallaValue = document.getElementById("talla_id").value;

    if (servicioValue !== "" && tallaValue !== "") {
        try {
            const response = await axios.get(`/procedimientos/precio/${servicioValue}/${tallaValue}`);
            
            if (response.data.success) {
                document.getElementById(
                    "precio_mostrar"
                ).value = `${moneyFormat(response.data.data.valor)}`;
                document.getElementById(
                    "valor_precio"
                ).value = `${response.data.data.valor}`;
                document.getElementById(
                    "comision"
                ).value = `${response.data.data.comision}`;

                // Llama a calcularPrecioFinal después de completar calcularPrecio
                calcularPrecioFinal();
            } else {
                notifications("Atencion!", response.data.message, "error");
                document.getElementById("valor_precio").value = "";
                document.getElementById("comision").value = "";
                document.getElementById("precio_mostrar").value = "";
            }
        } catch (error) {
            // Maneja errores aquí
        }
    }
    calcularPrecioFinal();
}




function calcularPrecioFinal() {
    const valorPrecio = parseFloat(valorPrecioInput.value) || 0;
    const valorAbono = parseFloat(valorAbonoInput.value) || 0;
    const planSeleccionado = planesSelect.options[planesSelect.selectedIndex];
    const descuento =   parseFloat(planSeleccionado.getAttribute("data-descuento")) || 0;
    
  
    let precioFinal = valorPrecio - valorAbono;   
  

    // Aplica el descuento si existe
    if (descuento > 0) {
        const descuentoAplicado = (precioFinal * descuento) / 100;
        precioFinal -= descuentoAplicado;
    }

    if (isNaN(precioFinal) || precioFinal < 0) {
        precioFinal = 0;
    }    
   
   
    valorPagarInput.value = precioFinal;
    totalCuenta.innerText =  ''
    totalCuenta.innerText =  `$${moneyFormat(precioFinal)}`
}
