import { initTable, getData, notifications, notyfError } from "./general.js";
const doc = document;
const valorPrecioInput = document.getElementById("valor_precio");
const valorAbonoInput = document.getElementById("valor_abono");
const planesSelect = document.getElementById("planes_id");
const valorPagarInput = document.getElementById("valor_pagar");
const totalCuenta = document.getElementById("total_cuenta");
const valorNeto = document.getElementById("valor-neto");
const saldo = document.getElementById("saldo");
let totalNeto = 0;
let $myForm = doc.getElementById("myForm");
var elementos = $myForm.elements;

// const medioPagoSelect = document.getElementById('medio_pago');
// const cuentaPagoSelect = document.getElementById('cuenta_pago_id');
// const medioPagoId = document.getElementById('medio_pago_id');

doc.addEventListener("DOMContentLoaded", function (e) {
    let pristineForm = new Pristine($myForm);
    const btnAdd = document.querySelector(".btnAdd");
    const clonableDiv = document.querySelector(".clonar");
    const pagos = [];
    let contador = 0;

    btnAdd.addEventListener("click", function () {
        contador++;

        const clonedDiv = clonableDiv.cloneNode(true); // Clonar el div con todos sus elementos

        // Modificar los atributos name e id de los elementos clonados
        clonedDiv.querySelectorAll("[name], [id]").forEach(function (elemento) {
            const nombreOriginal = elemento.getAttribute("name");
            const idOriginal = elemento.getAttribute("id");
            // Reemplazar cualquier número en el nombre con el valor actual del

            const matches = nombreOriginal.match(/(\d+)$/);
            if (matches) {
                const numeroOriginal = parseInt(matches[0]);
                const nuevoNumero = numeroOriginal + contador;
                const nuevoNombre = nombreOriginal.replace(
                    numeroOriginal,
                    nuevoNumero
                );
                const nuevoId = idOriginal.replace(numeroOriginal, nuevoNumero);

                elemento.setAttribute("name", nuevoNombre);
                elemento.setAttribute("id", nuevoId);
                elemento.removeAttribute("data-pristine-required-message");
                elemento.removeAttribute("required");
            }
        });
        // Limpiar los valores en los campos clonados
        clonedDiv.querySelectorAll("input, select").forEach(function (input) {
            input.value = ""; // Establecer el valor en blanco
        });

        const btnEliminar = document.createElement("button");
        btnEliminar.type = "button";
        btnEliminar.className = "btn btn-danger";
        btnEliminar.title = "Eliminar Fila";
        btnEliminar.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"><path fill="#f3f2f2" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm5 11H7v-2h10v2z"/></svg>`;
        btnEliminar.addEventListener("click", function () {
            clonedDiv.remove(); // Eliminar el elemento clonado
            recalcularSumatoria();
        });

        clonedDiv.querySelector(".col-md-1").innerHTML = ""; // Limpiar el contenido del último div
        clonedDiv.querySelector(".col-md-1").appendChild(btnEliminar); // Agregar el botón de eliminar

        clonableDiv.parentElement.insertBefore(
            clonedDiv,
            clonableDiv.nextSibling
        ); // Agregar el clon justo debajo del original
    });

    totalCuenta.innerText = `$${0}`;
    valorNeto.innerText = `$${0}`;
    saldo.innerText = `$${0}`;
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

    $myForm.addEventListener("submit", (e) => {
        e.preventDefault();
        let valid = pristineForm.validate();
        if (valid) {
            let datos = getData(e.target);
            const form = new FormData(e.target);
            const valores = [];
            // Crear un objeto temporal para almacenar los datos de un conjunto de campos
            let tempValores = {};
            let camposInvalidos = [];
            let sumaValorPago = 0;

            for (const [nombre, valor] of form.entries()) {
                if (
                    nombre.startsWith("medio_pago_") ||
                    nombre.startsWith("cuenta_pago_") ||
                    nombre.startsWith("referencia_pago_") ||
                    nombre.startsWith("valor_pago_")
                ) {
                    const campo = nombre.split("_")[0]; // Obtener el nombre del campo
                    const numero = nombre.split("_")[2]; // Obtener el número del campo

                    if (!tempValores[numero]) {
                        tempValores[numero] = {};
                    }

                   tempValores[numero][campo] = valor;
                    

                }
                if (nombre.startsWith("medio_pago_")) {
                    const numero = nombre.split("_")[2]; // Obtener el número del campo
                    let medioPagoSelect = document.querySelector(
                        `select[name="medio_pago_${numero}"]`
                    );
                    const idMedio =
                        medioPagoSelect.options[
                            medioPagoSelect.selectedIndex
                        ].getAttribute("data-idMedio");
                    tempValores[numero]["idMedio"] = idMedio;  // Agregar el valor al objeto valores
                }
                if (
                    !valor &&
                    !nombre.startsWith("referencia_pago_") &&
                    !nombre.endsWith("planes_id") &&
                    !nombre.endsWith("observaciones")
                ) {
                    camposInvalidos.push(nombre);
                }
                if (nombre.startsWith("valor_pago_")) {
                    // Convertir el valor a número y sumarlo
                    const valorNumerico = parseFloat(valor);
                    if (!isNaN(valorNumerico)) {
                        sumaValorPago += valorNumerico;
                    }
                }
            }

            // Comprobar si hay campos inválidos
            if (camposInvalidos.length > 0) {
                camposInvalidos.forEach((el) => {
                    notyfError.open({
                        type: "error",
                        message: `el campo ${el} es requerido`,
                        duration: 8000,
                    });
                });
                return;
            }
            if (sumaValorPago !== parseFloat(datos.valor_pagar)) {
                Swal.fire(
                    "Cuidado!",
                    "Los valores a pagar no coinciden!",
                    "error"
                );
                return;
            }
            for (const numero in tempValores) {
                if (tempValores.hasOwnProperty(numero)) {
                    valores.push(tempValores[numero]);
                }
            }
            console.log(datos, valores);
            Swal.fire({
                title: "¿Esta seguro de realizar esta transaccion?",
                text: "No se podra parar el pago",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, confirmar!",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .post("/procedimientos", { datos, valores })
                        .then(function (response) {
                            console.log(response);
            if (response.data.success) {
                Swal.fire(
                    response.data.message,
                    `Valor Pagado: ${moneyFormat(response.data.valor)}`,
                    'success'
                  )
                  $myForm.reset();
                  $myForm.classList.add("d-none");
                  document.querySelector('.divReferencia').classList.add('d-none');
                  totalCuenta.innerText =  `$${0}`
                  valorNeto.innerText = `$${0}`;
                  saldo.innerText = `$${0}`
                  saldo.classList.remove('text-success')
                  saldo.classList.remove('text-danger')
                  setTimeout(()=>{
                    location.reload();
                   },3000)

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
                            if (error) {
                                response.data.errors.forEach((el) => {
                                    notyfError.open({
                                        type: "error",
                                        message: el,
                                        duration: 8000,
                                    });
                                });
                            }
                        });
                }
            });
        }
    });

    document.addEventListener("click", (e) => {
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
                    document
                        .querySelector(".divReferencia")
                        .classList.add("d-none");
                    totalCuenta.innerText = `$${0}`;
                    valorNeto.innerText = `$${0}`;
                    saldo.innerText = `$${0}`;
                    saldo.classList.remove("text-success");
                    saldo.classList.remove("text-danger");
                }
            });
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
        let selectedMedioId;
        if (e.target.matches("#servicio_id")) {
            calcularPrecio();
        }
        if (e.target.matches("#talla_id")) {
            calcularPrecio();
        }
        if (e.target.matches(".medioPago")) {
            for (var i = 0; i < 9; i++) {
                if (e.target.id == `medio_pago_${i}`) {
                    let cuentaPagoSelect = document.getElementById(
                        `cuenta_pago_${i}`
                    );
                    cuentaPagoSelect.value = "";
                    let medioPagoSelect = document.getElementById(
                        `medio_pago_${i}`
                    );
                    selectedMedioId =
                        medioPagoSelect.options[
                            medioPagoSelect.selectedIndex
                        ].getAttribute("data-idMedio");

                    for (let i = 0; i < cuentaPagoSelect.options.length; i++) {
                        const option = cuentaPagoSelect.options[i];
                        const optionMedioId =
                            option.getAttribute("data-medioId");

                        if (
                            optionMedioId === selectedMedioId ||
                            !selectedMedioId
                        ) {
                            option.style.display = ""; // Muestra la opción
                        } else {
                            option.style.display = "none"; // Oculta la opción que no coincide
                        }
                    }
                    if (e.target.value == "EFECTIVO") {
                        document.getElementById(
                            `referencia_pago_${i}`
                        ).readOnly = true;
                    } else {
                        document.getElementById(
                            `referencia_pago_${i}`
                        ).readOnly = false;
                    }
                }
            }
        }
        if (e.target.matches(".cuentaPago")) {
            for (var i = 0; i < 9; i++) {
                if (e.target.id == `cuenta_pago_${i}`) {
                    let cuentaPagoSelect = document.getElementById(
                        `cuenta_pago_${i}`
                    );
                    let medioPagoSelect = document.getElementById(
                        `medio_pago_${i}`
                    );
                    let selectedCuenta =
                        cuentaPagoSelect.options[
                            cuentaPagoSelect.selectedIndex
                        ].getAttribute("data-medioId");
                    let optionMedio =
                        medioPagoSelect.options[
                            medioPagoSelect.selectedIndex
                        ].getAttribute("data-idMedio");
                    if (selectedCuenta != optionMedio) {
                        medioPagoSelect.value = "";
                    }
                }
            }
        }
        if (e.target.matches(".valorPago")) {
            recalcularSumatoria();
        }
    });

    document.querySelectorAll("#format").forEach((el) => {
        let valueConversion = new Intl.NumberFormat("es-CO").format(
            el.innerText
        );
        el.innerText = `$ ${valueConversion}`;
    });
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
            const response = await axios.get(
                `/procedimientos/precio/${servicioValue}/${tallaValue}`
            );

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
    const descuento =
        parseFloat(planSeleccionado.getAttribute("data-descuento")) || 0;

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
    totalCuenta.innerText = "";
    totalCuenta.innerText = `$${moneyFormat(precioFinal)}`;
    recalcularSumatoria();
}

function recalcularSumatoria() {
    totalNeto = 0;
    for (var i = 0; i < elementos.length; i++) {
        var elemento = elementos[i];
        if (elemento.name && elemento.name.startsWith("valor_pago_")) {
            var valor = parseFloat(elemento.value);
            if (!isNaN(valor)) {
                totalNeto += valor;
            }
        }
    }
    let substract = parseFloat(valorPagarInput.value) - parseFloat(totalNeto);
    saldo.classList.remove("text-success");
    saldo.classList.remove("text-danger");
    if (substract === 0) {
        saldo.classList.add("text-success");
    } else if (substract < 0) {
        saldo.classList.add("text-danger");
    }
    valorNeto.innerText = isNaN(totalNeto)
        ? `$${0}`
        : `$${moneyFormat(totalNeto)}`;
    saldo.innerText = isNaN(substract) ? `$${0}` : `$${moneyFormat(substract)}`;
}
